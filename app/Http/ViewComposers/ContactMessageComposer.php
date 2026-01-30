<?php

namespace App\Http\ViewComposers;

use App\Models\ContactMessage;
use Illuminate\View\View;

/**
 * ViewComposer untuk membagikan jumlah pesan kontak baru ke sidebar admin.
 * Design Pattern: View Composer Pattern
 */
class ContactMessageComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Hanya hitung jika user sudah login dan di halaman admin
        if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isOwner())) {
            $newMessagesCount = ContactMessage::where('status', 'baru')->count();
            $view->with('newMessagesCount', $newMessagesCount);
        } else {
            $view->with('newMessagesCount', 0);
        }
    }
}
