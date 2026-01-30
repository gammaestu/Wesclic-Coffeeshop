<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'shop_name',
        'shop_address',
        'shop_phone',
        'shop_logo',
        'tax',
        'map_lat',
        'map_lng',
        'map_place_query',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tax' => 'decimal:2',
        ];
    }

    /**
     * Get shop settings (singleton pattern)
     */
    public static function getShopSettings(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'shop_name' => 'Coffee Shop',
                'shop_address' => '',
                'shop_phone' => '',
                'shop_logo' => null,
                'tax' => 0,
                'map_lat' => null,
                'map_lng' => null,
                'map_place_query' => null,
            ]
        );
    }

    /**
     * Get the logo URL
     */
    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->shop_logo) {
            return null;
        }

        // If logo is already a full URL, return it
        if (filter_var($this->shop_logo, FILTER_VALIDATE_URL)) {
            return $this->shop_logo;
        }

        // Otherwise, return the storage URL
        return asset('storage/' . $this->shop_logo);
    }

    /**
     * URL embed peta (Google Maps) untuk iframe - koordinat tepat agar akurat.
     */
    public function getMapEmbedUrlAttribute(): string
    {
        if ($this->map_lat && $this->map_lng) {
            return 'https://www.google.com/maps?q=' . (float) $this->map_lat . ',' . (float) $this->map_lng . '&output=embed';
        }
        $query = $this->map_place_query ?: $this->shop_address ?: 'Wesclic Coffee Shop, Cobongan Ngestiharjo Kasihan Bantul';
        return 'https://www.google.com/maps?q=' . rawurlencode($query) . '&output=embed';
    }

    /**
     * URL buka di Google Maps (link eksternal).
     */
    public function getMapLinkUrlAttribute(): string
    {
        if ($this->map_lat && $this->map_lng) {
            return 'https://www.google.com/maps?q=' . (float) $this->map_lat . ',' . (float) $this->map_lng;
        }
        $query = $this->map_place_query ?: $this->shop_address ?: '683W+6QR Cobongan Ngestiharjo Kasihan Bantul 55184';
        return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($query);
    }
}
