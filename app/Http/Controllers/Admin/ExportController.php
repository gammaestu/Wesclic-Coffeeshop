<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function ordersExcel()
    {
        return Excel::download(new OrdersExport(), 'orders.xlsx');
    }

    public function ordersPdf()
    {
        $orders = Order::with('customer')->latest()->limit(500)->get();

        $pdf = Pdf::loadView('admin.exports.orders-pdf', [
            'orders' => $orders,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('orders.pdf');
    }
}

