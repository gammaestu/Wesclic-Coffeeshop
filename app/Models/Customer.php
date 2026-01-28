<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'type',
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
     * Get the orders for the customer.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get completed orders for the customer.
     */
    public function completedOrders(): HasMany
    {
        return $this->hasMany(Order::class)->where('status', 'selesai');
    }

    /**
     * Check if customer is a member
     */
    public function isMember(): bool
    {
        return $this->type === 'member';
    }

    /**
     * Check if customer is walk-in
     */
    public function isWalkIn(): bool
    {
        return $this->type === 'walk-in';
    }
}
