<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

/**
 * Service untuk integrasi Midtrans (Snap: transfer, QRIS, e-wallet).
 * Design pattern: Lazy initialization — config Midtrans hanya di-set saat dibutuhkan
 * agar tidak throw exception saat .env belum dikonfigurasi.
 */
class PaymentGatewayService
{
    private bool $configApplied = false;

    public function __construct()
    {
        // Tidak set MidtransConfig di constructor agar app tidak error jika key kosong.
        // Config di-set lazy di ensureMidtransConfig() saat createSnapToken() dipanggil.
    }

    /**
     * Set Midtrans config sekali per request. Dipanggil sebelum Snap API.
     *
     * @throws \InvalidArgumentException Jika server_key kosong
     */
    private function ensureMidtransConfig(): void
    {
        if ($this->configApplied) {
            return;
        }

        $serverKey = config('midtrans.server_key');
        $clientKey = config('midtrans.client_key');

        if (empty($serverKey) || is_string($serverKey) && str_starts_with(strtolower(trim($serverKey)), 'your ')) {
            throw new \InvalidArgumentException(
                'Midtrans server key belum dikonfigurasi. Set MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY di .env'
            );
        }

        MidtransConfig::$serverKey = $serverKey;
        MidtransConfig::$clientKey = $clientKey ?: '';
        MidtransConfig::$isProduction = (bool) config('midtrans.is_production');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        $this->configApplied = true;
    }

    /**
     * Buat transaksi Midtrans Snap untuk order; simpan Payment record; return snap token.
     * Dipakai saat customer pilih "Transfer / QRIS / E-wallet".
     *
     * @throws \Exception
     */
    public function createSnapToken(Order $order): string
    {
        $this->ensureMidtransConfig();

        $order->load(['customer', 'orderItems.menu']);

        $orderId = $order->order_code;
        $grossAmount = (int) round((float) $order->total_price);

        $itemDetails = $order->orderItems->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'price' => (int) round((float) $item->price),
                'quantity' => (int) $item->quantity,
                'name' => $item->menu?->name ?? 'Item',
            ];
        })->all();

        $customer = $order->customer;
        $customerDetails = [
            'first_name' => $customer ? explode(' ', $customer->name)[0] ?? 'Customer' : 'Customer',
            'last_name' => $customer ? (explode(' ', $customer->name)[1] ?? '') : '',
            'email' => $customer->email ?? '',
            'phone' => $customer->phone ?? '',
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($params);

        DB::transaction(function () use ($order, $grossAmount, $orderId) {
            Payment::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'gateway' => 'midtrans',
                ],
                [
                    'amount' => $grossAmount,
                    'method' => 'transfer',
                    'status' => 'pending',
                    'transaction_id' => $orderId,
                    'payload' => ['created_via' => 'snap'],
                ]
            );
        });

        return $snapToken;
    }

    /**
     * Cek apakah Midtrans dikonfigurasi (untuk tampilkan opsi transfer).
     */
    public function isConfigured(): bool
    {
        $serverKey = config('midtrans.server_key');
        return !empty($serverKey) && strpos($serverKey, 'your ') === false;
    }
}
