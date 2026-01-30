<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;

/**
 * Webhook dari Midtrans (HTTP notification).
 * Route: POST /payment/notification
 */
class PaymentNotificationController extends Controller
{
    public function __invoke(Request $request): Response
    {
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');

        try {
            $notif = new Notification();
        } catch (\Throwable $e) {
            Log::warning('Midtrans notification parse error: ' . $e->getMessage());
            return response('Invalid notification', 400);
        }

        $response = $notif->getResponse();
        $orderId = $response->order_id ?? null;
        $transactionStatus = $response->transaction_status ?? '';
        $paymentType = $response->payment_type ?? '';

        if (!$orderId) {
            return response('Missing order_id', 400);
        }

        $order = Order::where('order_code', $orderId)->first();
        if (!$order) {
            Log::warning('Midtrans notification: order not found', ['order_id' => $orderId]);
            return response('Order not found', 404);
        }

        $payment = $order->payments()->where('gateway', 'midtrans')->first();
        if ($payment) {
            PaymentLog::create([
                'payment_id' => $payment->id,
                'status' => $transactionStatus,
                'message' => $transactionStatus,
                'raw_response' => (array) $response,
            ]);
        }

        $payment = $order->payments()->where('gateway', 'midtrans')->latest()->first();

        DB::transaction(function () use ($order, $response, $transactionStatus, $payment) {
            if ($payment) {
                $newStatus = $this->mapTransactionStatus($transactionStatus);
                $payment->update([
                    'status' => $newStatus,
                    'payload' => array_merge($payment->payload ?? [], (array) $response),
                    'paid_at' => in_array($transactionStatus, ['capture', 'settlement']) ? now() : $payment->paid_at,
                ]);
            }

            if (in_array($transactionStatus, ['capture', 'settlement'])) {
                $order->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);
            } elseif (in_array($transactionStatus, ['pending'])) {
                // Tetap unpaid
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $order->update(['payment_status' => 'unpaid']);
                if ($payment) {
                    $payment->update(['status' => $this->mapTransactionStatus($transactionStatus)]);
                }
            }
        });

        return response('OK', 200);
    }

    private function mapTransactionStatus(string $status): string
    {
        return match ($status) {
            'capture', 'settlement' => 'success',
            'pending' => 'pending',
            'deny', 'expire', 'cancel' => 'failed',
            default => 'pending',
        };
    }
}
