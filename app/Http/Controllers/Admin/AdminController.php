<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard(): View
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_menus' => Menu::count(),
            'available_menus' => Menu::where('status', 'tersedia')->count(),
            'out_of_stock' => Menu::where('status', 'habis')->orWhere('stock', 0)->count(),
            'total_orders' => Order::count(),
            'today_orders' => Order::whereDate('created_at', today())->count(),
        ];

        $recentMenus = Menu::with('category')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentMenus' => $recentMenus,
        ]);
    }
}