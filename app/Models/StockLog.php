<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'menu_id',
        'change',
        'reason',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'change' => 'integer',
        ];
    }

    /**
     * Get the menu that owns the stock log.
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the user who made the change.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if change is positive (increase)
     */
    public function isIncrease(): bool
    {
        return $this->change > 0;
    }

    /**
     * Check if change is negative (decrease)
     */
    public function isDecrease(): bool
    {
        return $this->change < 0;
    }

    /**
     * Get formatted change value with sign
     */
    public function getFormattedChangeAttribute(): string
    {
        return ($this->change >= 0 ? '+' : '') . $this->change;
    }
}
