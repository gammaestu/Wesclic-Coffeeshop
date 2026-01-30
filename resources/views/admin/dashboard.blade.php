@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Categories</p>
                    <p class="text-3xl font-bold text-[#3A3A3A]">{{ $stats['total_categories'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#A3B18A]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#A3B18A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Menus</p>
                    <p class="text-3xl font-bold text-[#3A3A3A]">{{ $stats['total_menus'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#B08968]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#B08968]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Available Menus</p>
                    <p class="text-3xl font-bold text-[#A3B18A]">{{ $stats['available_menus'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#A3B18A]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#A3B18A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Out of Stock</p>
                    <p class="text-3xl font-bold text-red-500">{{ $stats['out_of_stock'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Orders (Lunas)</p>
                    <p class="text-3xl font-bold text-[#3A3A3A]">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#D4A373]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Today's Orders (Lunas)</p>
                    <p class="text-3xl font-bold text-[#B08968]">{{ $stats['today_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#B08968]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#B08968]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-amber-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Order Belum Bayar</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $stats['total_orders_unpaid'] ?? 0 }}</p>
                    <p class="text-xs text-[#3A3A3A]/60 mt-1">Hari ini: {{ $stats['today_orders_unpaid'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-[#3A3A3A]">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-[#A3B18A]/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#A3B18A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Pendapatan Hari Ini</p>
                    <p class="text-2xl font-bold text-[#B08968]">Rp {{ number_format($stats['today_revenue'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#3A3A3A]/70 mb-1">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-bold text-[#D4A373]">Rp {{ number_format($stats['month_revenue'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan & Pendapatan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-bold text-[#3A3A3A] mb-4">Grafik Penjualan (14 Hari Terakhir)</h2>
            <div class="h-72">
                <canvas id="chartSalesDay" height="280"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-bold text-[#3A3A3A] mb-4">Grafik Pendapatan (14 Hari Terakhir)</h2>
            <div class="h-72">
                <canvas id="chartRevenueDay" height="280"></canvas>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-bold text-[#3A3A3A] mb-4">Grafik Penjualan (6 Bulan Terakhir)</h2>
            <div class="h-72">
                <canvas id="chartSalesMonth" height="280"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-bold text-[#3A3A3A] mb-4">Grafik Pendapatan (6 Bulan Terakhir)</h2>
            <div class="h-72">
                <canvas id="chartRevenueMonth" height="280"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Menus -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#3A3A3A]">Recent Menus</h2>
            <a href="{{ route('admin.menus.index') }}" class="text-sm text-[#B08968] hover:text-[#D4A373] transition-colors">
                View All →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#A3B18A]/20">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Name</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Category</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Price</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Stock</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Status</th>
                        <th class="text-right py-3 px-4 text-sm font-semibold text-[#3A3A3A]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMenus as $menu)
                        <tr class="border-b border-[#A3B18A]/10 hover:bg-[#F7F7F2] transition-colors">
                            <td class="py-3 px-4 text-[#3A3A3A]">{{ $menu->name }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-[#A3B18A]/20 text-[#A3B18A] rounded-full text-xs font-medium">
                                    {{ $menu->category->name }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-[#3A3A3A] font-semibold">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-[#3A3A3A]">{{ $menu->stock }}</td>
                            <td class="py-3 px-4">
                                @if($menu->status === 'tersedia')
                                    <span class="px-2 py-1 bg-green-500/20 text-green-600 rounded-full text-xs font-medium">Available</span>
                                @else
                                    <span class="px-2 py-1 bg-red-500/20 text-red-600 rounded-full text-xs font-medium">Out of Stock</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="text-[#B08968] hover:text-[#D4A373] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[#3A3A3A]/70">No menus found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(163, 177, 138, 0.15)' },
                ticks: { color: '#3A3A3A' }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#3A3A3A', maxRotation: 45 }
            }
        }
    };
    const chartOptionsBar = { ...chartOptions, scales: { ...chartOptions.scales, y: { ...chartOptions.scales.y, ticks: { ...chartOptions.scales.y.ticks, stepSize: 1 } } } };

    const salesDayLabels = @json($salesByDay['labels'] ?? []);
    const salesDayData = @json($salesByDay['data'] ?? []);
    if (document.getElementById('chartSalesDay')) {
        new Chart(document.getElementById('chartSalesDay'), {
            type: 'bar',
            data: {
                labels: salesDayLabels,
                datasets: [{
                    label: 'Jumlah Order',
                    data: salesDayData,
                    backgroundColor: 'rgba(163, 177, 138, 0.6)',
                    borderColor: '#A3B18A',
                    borderWidth: 1
                }]
            },
            options: chartOptionsBar
        });
    }

    const revenueDayLabels = @json($revenueByDay['labels'] ?? []);
    const revenueDayData = @json($revenueByDay['data'] ?? []);
    if (document.getElementById('chartRevenueDay')) {
        new Chart(document.getElementById('chartRevenueDay'), {
            type: 'line',
            data: {
                labels: revenueDayLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenueDayData,
                    borderColor: '#B08968',
                    backgroundColor: 'rgba(176, 137, 104, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: chartOptions
        });
    }

    const salesMonthLabels = @json($salesByMonth['labels'] ?? []);
    const salesMonthData = @json($salesByMonth['data'] ?? []);
    if (document.getElementById('chartSalesMonth')) {
        new Chart(document.getElementById('chartSalesMonth'), {
            type: 'bar',
            data: {
                labels: salesMonthLabels,
                datasets: [{
                    label: 'Jumlah Order',
                    data: salesMonthData,
                    backgroundColor: 'rgba(212, 163, 115, 0.6)',
                    borderColor: '#D4A373',
                    borderWidth: 1
                }]
            },
            options: chartOptionsBar
        });
    }

    const revenueMonthLabels = @json($revenueByMonth['labels'] ?? []);
    const revenueMonthData = @json($revenueByMonth['data'] ?? []);
    if (document.getElementById('chartRevenueMonth')) {
        new Chart(document.getElementById('chartRevenueMonth'), {
            type: 'line',
            data: {
                labels: revenueMonthLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenueMonthData,
                    borderColor: '#A3B18A',
                    backgroundColor: 'rgba(163, 177, 138, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                        ticks: {
                            ...chartOptions.scales.y.ticks,
                            callback: function (value) {
                                if (value >= 1000000) return (value / 1000000) + 'jt';
                                if (value >= 1000) return (value / 1000) + 'k';
                                return value;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush