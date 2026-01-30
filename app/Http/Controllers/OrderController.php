<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Create order from cart items (checkout/pesan).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'customer_email' => ['nullable', 'email', 'max:150'],
            'customer_address' => ['nullable', 'string'],
            'customer_type' => ['required', Rule::in(['member', 'walk-in'])],
            'payment_method' => ['required', Rule::in(['cash', 'transfer'])],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'exists:menus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        $items = collect($validated['items'])
            ->groupBy('id')
            ->map(fn ($rows) => (int) $rows->sum('quantity'))
            ->map(fn ($qty, $id) => ['id' => (int) $id, 'quantity' => (int) $qty])
            ->values();

        $order = DB::transaction(function () use ($validated, $items) {
            $customer = Customer::create([
                'name' => $validated['customer_name'],
                'phone' => $validated['customer_phone'] ?? null,
                'email' => $validated['customer_email'] ?? null,
                'address' => $validated['customer_address'] ?? null,
                'type' => $validated['customer_type'],
            ]);

            $menuIds = $items->pluck('id')->all();
            $menus = Menu::whereIn('id', $menuIds)->lockForUpdate()->get()->keyBy('id');

            // Validate availability & stock
            foreach ($items as $row) {
                /** @var Menu|null $menu */
                $menu = $menus->get($row['id']);
                if (!$menu) {
                    abort(422, 'Invalid menu item.');
                }
                if ($menu->isOutOfStock() || $menu->stock < $row['quantity']) {
                    abort(422, "Stock not enough for {$menu->name}.");
                }
            }

            $order = Order::create([
                'order_code' => Order::generateOrderCode(),
                'customer_id' => $customer->id,
                'total_price' => 0,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $validated['payment_method'],
                'order_date' => now(),
                'notes' => $validated['notes'] ?? null,
                'created_by' => auth()->id(),
            ]);

            $total = 0;
            foreach ($items as $row) {
                /** @var Menu $menu */
                $menu = $menus->get($row['id']);
                $price = (float) $menu->price;
                $qty = (int) $row['quantity'];
                $subtotal = $price * $qty;
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                // Deduct stock
                $menu->decrement('stock', $qty);
                if ($menu->stock <= 0) {
                    $menu->update(['status' => 'habis']);
                }
            }

            $order->update([
                'total_price' => $total,
            ]);

            OrderStatusLog::create([
                'order_id' => $order->id,
                'status' => 'pending',
                'changed_by' => auth()->id(),
            ]);

            return $order->fresh(['customer', 'orderItems.menu', 'statusLogs']);
        });

        $request->session()->put('last_order_code', $order->order_code);

        $recentCodes = $this->getRecentOrderCodesFromCookie($request);
        array_unshift($recentCodes, $order->order_code);
        $recentCodes = array_unique($recentCodes);
        $recentCodes = array_slice(array_values($recentCodes), 0, 10);

        return redirect()
            ->route('orders.show', $order->order_code)
            ->cookie('recent_order_codes', json_encode($recentCodes), 30 * 24 * 60); // 30 days
    }

    /**
     * Get recent order codes from cookie (persists across browser close / no login).
     */
    private function getRecentOrderCodesFromCookie(Request $request): array
    {
        $raw = $request->cookie('recent_order_codes');
        if (! $raw) {
            return [];
        }
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Show order status/detail page for customer.
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

        $order->load(['customer', 'orderItems.menu', 'statusLogs.changer']);

        return view('pages.order-status', [
            'order' => $order,
        ]);
    }

    /**
     * Status lookup page (enter order code or show recent orders from cookie/session).
     */
    public function statusLookup(Request $request): View|RedirectResponse
    {
        if ($request->filled('order_code')) {
            $orderCode = $request->string('order_code')->trim();
            $order = Order::where('order_code', $orderCode)->first();
            
            if ($order) {
                return redirect()->route('orders.show', $order->order_code);
            }

            return view('pages.status', [
                'error' => 'Kode pesanan tidak ditemukan. Pastikan kode pesanan yang Anda masukkan benar.',
                'lastOrderCode' => $request->session()->get('last_order_code'),
                'recentOrderCodes' => $this->mergeRecentOrderCodes($request),
            ]);
        }

        return view('pages.status', [
            'error' => null,
            'lastOrderCode' => $request->session()->get('last_order_code'),
            'recentOrderCodes' => $this->mergeRecentOrderCodes($request),
        ]);
    }

    /**
     * Merge recent order codes from session and cookie (cookie persists when user leaves/closes browser).
     * Filters out invalid order codes that no longer exist in database.
     */
    private function mergeRecentOrderCodes(Request $request): array
    {
        $fromSession = $request->session()->get('last_order_code') ? [$request->session()->get('last_order_code')] : [];
        $fromCookie = $this->getRecentOrderCodesFromCookie($request);
        $merged = array_values(array_unique(array_merge($fromSession, $fromCookie)));
        
        // Filter out order codes that don't exist in database (e.g., after migrate fresh seed)
        $validCodes = Order::whereIn('order_code', $merged)->pluck('order_code')->toArray();
        $filtered = array_intersect($merged, $validCodes);
        
        return array_slice($filtered, 0, 10);
    }
}

