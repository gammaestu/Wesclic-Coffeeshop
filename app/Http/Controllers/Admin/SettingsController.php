<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => Setting::getShopSettings(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = Setting::getShopSettings();

        $validated = $request->validate([
            'shop_name' => ['required', 'string', 'max:150'],
            'shop_address' => ['nullable', 'string'],
            'shop_phone' => ['nullable', 'string', 'max:30'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'map_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'map_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'map_place_query' => ['nullable', 'string', 'max:255'],
        ]);

        $settings->update([
            'shop_name' => $validated['shop_name'],
            'shop_address' => $validated['shop_address'] ?? '',
            'shop_phone' => $validated['shop_phone'] ?? '',
            'tax' => $validated['tax'] ?? 0,
            'map_lat' => $validated['map_lat'] ?? null,
            'map_lng' => $validated['map_lng'] ?? null,
            'map_place_query' => $validated['map_place_query'] ?? null,
        ]);

        return back()->with('success', 'Settings updated successfully.');
    }
}

