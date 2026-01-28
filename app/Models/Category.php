<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // No specific casts needed for this model
        ];
    }

    /**
     * Get the menus for the category.
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get active menus for the category.
     */
    public function activeMenus(): HasMany
    {
        return $this->hasMany(Menu::class)->where('status', 'tersedia');
    }

    /**
     * Check if category is active
     */
    public function isActive(): bool
    {
        return $this->status === 'aktif';
    }
}
