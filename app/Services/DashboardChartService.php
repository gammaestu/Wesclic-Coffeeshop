<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Carbon;

/**
 * Service untuk data grafik dashboard admin (penjualan & pendapatan).
 * Design pattern: Single Responsibility.
 */
class DashboardChartService
{
    /**
     * Data penjualan (jumlah order) per hari untuk N hari terakhir.
     * Hanya order yang sudah dibayar (payment_status = paid).
     *
     * @return array{labels: array<string>, data: array<int>}
     */
    public function getSalesByDay(int $days = 14): array
    {
        $start = Carbon::today()->subDays($days);
        $orders = Order::query()
            ->where('created_at', '>=', $start)
            ->where('payment_status', 'paid')
            ->get()
            ->groupBy(fn ($o) => Carbon::parse($o->created_at)->format('Y-m-d'))
            ->map(fn ($g) => $g->count());

        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->translatedFormat('d M');
            $data[] = (int) ($orders[$date] ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Data pendapatan (total_price) per hari untuk N hari terakhir.
     * Hanya order yang sudah dibayar (payment_status = paid) — uang yang benar-benar masuk.
     *
     * @return array{labels: array<string>, data: array<float>}
     */
    public function getRevenueByDay(int $days = 14): array
    {
        $start = Carbon::today()->subDays($days);
        $revenue = Order::query()
            ->where('created_at', '>=', $start)
            ->where('payment_status', 'paid')
            ->get()
            ->groupBy(fn ($o) => Carbon::parse($o->created_at)->format('Y-m-d'))
            ->map(fn ($g) => round((float) $g->sum('total_price'), 2));

        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->translatedFormat('d M');
            $data[] = (float) ($revenue[$date] ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Data penjualan (jumlah order) per bulan untuk N bulan terakhir.
     * Hanya order yang sudah dibayar (payment_status = paid).
     *
     * @return array{labels: array<string>, data: array<int>}
     */
    public function getSalesByMonth(int $months = 6): array
    {
        $start = Carbon::today()->startOfMonth()->subMonths($months - 1);
        $orders = Order::query()
            ->where('created_at', '>=', $start)
            ->where('payment_status', 'paid')
            ->get()
            ->groupBy(fn ($o) => Carbon::parse($o->created_at)->format('Y-m'))
            ->map(fn ($g) => $g->count());

        $labels = [];
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $month = Carbon::today()->subMonths($i)->format('Y-m');
            $labels[] = Carbon::parse($month . '-01')->translatedFormat('M Y');
            $data[] = (int) ($orders[$month] ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Data pendapatan (total_price) per bulan untuk N bulan terakhir.
     * Hanya order yang sudah dibayar (payment_status = paid).
     *
     * @return array{labels: array<string>, data: array<float>}
     */
    public function getRevenueByMonth(int $months = 6): array
    {
        $start = Carbon::today()->startOfMonth()->subMonths($months - 1);
        $revenue = Order::query()
            ->where('created_at', '>=', $start)
            ->where('payment_status', 'paid')
            ->get()
            ->groupBy(fn ($o) => Carbon::parse($o->created_at)->format('Y-m'))
            ->map(fn ($g) => round((float) $g->sum('total_price'), 2));

        $labels = [];
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $month = Carbon::today()->subMonths($i)->format('Y-m');
            $labels[] = Carbon::parse($month . '-01')->translatedFormat('M Y');
            $data[] = (float) ($revenue[$month] ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Ringkasan angka untuk kartu dashboard (pendapatan = hanya order yang sudah dibayar).
     *
     * @return array{total_revenue: float, today_revenue: float, month_revenue: float}
     */
    public function getRevenueSummary(): array
    {
        $todayRevenue = (float) Order::query()
            ->whereDate('created_at', today())
            ->where('payment_status', 'paid')
            ->sum('total_price');

        $monthRevenue = (float) Order::query()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('payment_status', 'paid')
            ->sum('total_price');

        $totalRevenue = (float) Order::query()
            ->where('payment_status', 'paid')
            ->sum('total_price');

        return [
            'total_revenue' => $totalRevenue,
            'today_revenue' => $todayRevenue,
            'month_revenue' => $monthRevenue,
        ];
    }
}
