<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Services\DashboardChartService;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        protected DashboardChartService $chartService
    ) {}

    /**
     * Display the admin dashboard with stats and sales/revenue charts.
     */
    public function dashboard(): View
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_menus' => Menu::count(),
            'available_menus' => Menu::where('status', 'tersedia')->count(),
            'out_of_stock' => Menu::where('status', 'habis')->orWhere('stock', 0)->count(),
            // Hanya order yang sudah dibayar — order belum bayar tidak masuk
            'total_orders' => Order::where('payment_status', 'paid')->count(),
            'today_orders' => Order::whereDate('created_at', today())->where('payment_status', 'paid')->count(),
            // Opsi: tampilkan juga jumlah order belum bayar (untuk monitoring)
            'total_orders_unpaid' => Order::where('payment_status', 'unpaid')->count(),
            'today_orders_unpaid' => Order::whereDate('created_at', today())->where('payment_status', 'unpaid')->count(),
        ];

        $revenueSummary = $this->chartService->getRevenueSummary();
        $stats['total_revenue'] = $revenueSummary['total_revenue'];
        $stats['today_revenue'] = $revenueSummary['today_revenue'];
        $stats['month_revenue'] = $revenueSummary['month_revenue'];

        $salesByDay = $this->chartService->getSalesByDay(14);
        $revenueByDay = $this->chartService->getRevenueByDay(14);
        $salesByMonth = $this->chartService->getSalesByMonth(6);
        $revenueByMonth = $this->chartService->getRevenueByMonth(6);

        $recentMenus = Menu::with('category')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentMenus' => $recentMenus,
            'salesByDay' => $salesByDay,
            'revenueByDay' => $revenueByDay,
            'salesByMonth' => $salesByMonth,
            'revenueByMonth' => $revenueByMonth,
        ]);
    }
}