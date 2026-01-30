<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk mengatur default settings termasuk koordinat peta
 * Design Pattern: Singleton Pattern - memastikan hanya ada satu record settings
 */
class SettingsSeeder extends Seeder
{
    /**
     * Default latitude dan longitude untuk peta terintegrasi
     */
    private const DEFAULT_LATITUDE = -7.79687506856175;
    private const DEFAULT_LONGITUDE = 110.34691469023313;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'shop_name' => 'Wesclic Coffee Shop',
                'shop_address' => 'Cobongan Ngestiharjo Kasihan Bantul',
                'shop_phone' => '',
                'shop_logo' => null,
                'tax' => 0,
                'map_lat' => self::DEFAULT_LATITUDE,
                'map_lng' => self::DEFAULT_LONGITUDE,
                'map_place_query' => null,
            ]
        );

        // Update existing settings jika belum ada koordinat
        $settings = Setting::find(1);
        if ($settings && (!$settings->map_lat || !$settings->map_lng)) {
            $settings->update([
                'map_lat' => self::DEFAULT_LATITUDE,
                'map_lng' => self::DEFAULT_LONGITUDE,
            ]);
        }
    }
}
