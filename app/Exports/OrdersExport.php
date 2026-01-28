<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Order::with('customer')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Order Code',
            'Customer',
            'Total',
            'Status',
            'Payment Status',
            'Order Date',
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_code,
            $order->customer?->name ?? '-',
            (string) $order->total_price,
            $order->status,
            $order->payment_status,
            optional($order->order_date)->format('Y-m-d H:i:s'),
        ];
    }
}

