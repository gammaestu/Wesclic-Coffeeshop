<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PaymentGatewayService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Halaman bayar untuk order (Transfer / Midtrans).
 * Route: GET /orders/{order}/pay
 */
class OrderPaymentController extends Controller
{
    public function __construct(
        private PaymentGatewayService $paymentGateway
    ) {}

    /**
     * Tampilkan halaman bayar dengan Snap token (hanya order unpaid + method transfer).
     */
    public function show(Request $request, string $order_code): View|RedirectResponse
    {
        // Manually resolve order to handle invalid/expired order codes gracefully
        $order = Order::where('order_code', $order_code)->first();
        
        if (!$order) {
            return redirect()
                ->route('orders.status')
                ->with('error', 'Pesanan tidak ditemukan. Kode pesanan mungkin sudah tidak valid atau telah dihapus.');
        }

        $order->load(['customer', 'orderItems.menu']);

        if ($order->payment_status === 'paid') {
            return redirect()
                ->route('orders.show', $order->order_code)
                ->with('info', 'Pesanan ini sudah dibayar.');
        }

        if ($order->payment_method !== 'transfer') {
            return redirect()
                ->route('orders.show', $order->order_code)
                ->with('info', 'Pembayaran untuk pesanan ini hanya bisa dilakukan di tempat (bayar tunai).');
        }

        if (!$this->paymentGateway->isConfigured()) {
            return redirect()
                ->route('orders.show', $order->order_code)
                ->with('error', 'Pembayaran online belum dikonfigurasi. Silakan bayar di tempat.');
        }

        try {
            $snapToken = $this->paymentGateway->createSnapToken($order);
        } catch (\Throwable $e) {
            report($e);
            return redirect()
                ->route('orders.show', $order->order_code)
                ->with('error', 'Gagal memuat halaman pembayaran. Silakan coba lagi atau bayar di tempat.');
        }

        $clientKey = config('midtrans.client_key');
        $snapScriptUrl = config('midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';

        return view('pages.pay', [
            'order' => $order,
            'snapToken' => $snapToken,
            'clientKey' => $clientKey,
            'snapScriptUrl' => $snapScriptUrl,
        ]);
    }
}
