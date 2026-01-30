<?php

namespace App\Http\Controllers;

use App\Services\PaymentGatewayService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentGatewayService $paymentGateway
    ) {}

    /**
     * Halaman checkout (form customer + pilih metode bayar).
     */
    public function index(): View
    {
        return view('pages.payment', [
            'canUseTransfer' => $this->paymentGateway->isConfigured(),
        ]);
    }

    /**
     * Redirect dari Midtrans setelah pembayaran berhasil.
     */
    public function finish(Request $request): RedirectResponse
    {
        $orderId = $request->query('order_id');
        if (!$orderId) {
            return redirect()->route('orders.status')->with('info', 'Pembayaran berhasil.');
        }
        $order = \App\Models\Order::where('order_code', $orderId)->first();
        if ($order) {
            return redirect()->route('orders.show', $order->order_code)->with('success', 'Pembayaran berhasil. Terima kasih!');
        }
        return redirect()->route('orders.status')->with('success', 'Pembayaran berhasil.');
    }

    /**
     * Redirect dari Midtrans saat pembayaran gagal/batal.
     */
    public function error(Request $request): RedirectResponse
    {
        $orderId = $request->query('order_id');
        if (!$orderId) {
            return redirect()->route('orders.status')->with('error', 'Pembayaran dibatalkan atau gagal.');
        }
        $order = \App\Models\Order::where('order_code', $orderId)->first();
        if ($order) {
            return redirect()->route('orders.show', $order->order_code)->with('error', 'Pembayaran dibatalkan atau gagal. Silakan coba lagi atau bayar di tempat.');
        }
        return redirect()->route('orders.status')->with('error', 'Pembayaran dibatalkan atau gagal.');
    }
}
