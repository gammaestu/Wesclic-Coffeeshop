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
}
