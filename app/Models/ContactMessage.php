<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model pesan kontak dari halaman "Hubungi Kami".
 * Design pattern: Active Record (Eloquent) + kecil dan fokus.
 */
class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'admin_reply',
        'replied_by',
        'replied_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
        ];
    }

    /**
     * Admin yang membalas pesan.
     */
    public function replier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Cek status pesan.
     */
    public function isNew(): bool
    {
        return $this->status === 'baru';
    }

    public function isRead(): bool
    {
        return $this->status === 'dibaca';
    }

    public function isReplied(): bool
    {
        return $this->status === 'dibalas';
    }
}

