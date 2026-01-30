<?php

namespace App\Services;

use App\Mail\ContactReplyMail;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Service layer untuk mengelola pesan kontak.
 * Design pattern: Service Layer (memisahkan logika bisnis dari controller).
 */
class ContactMessageService
{
    /**
     * Simpan pesan dari form contact.
     */
    public function storeFromRequest(Request $request): ContactMessage
    {
        $data = $request->only(['name', 'email', 'phone', 'message']);

        return ContactMessage::create($data);
    }

    /**
     * Tandai pesan sebagai dibaca.
     */
    public function markAsRead(ContactMessage $message): void
    {
        if ($message->isNew()) {
            $message->update(['status' => 'dibaca']);
        }
    }

    /**
     * Balas pesan dan kirim email ke user.
     */
    public function reply(ContactMessage $message, User $admin, string $replyText): void
    {
        $message->update([
            'admin_reply' => $replyText,
            'status' => 'dibalas',
            'replied_by' => $admin->id,
            'replied_at' => now(),
        ]);

        /** @var Mailer $mailer */
        $mailer = Mail::mailer();

        $mailer->to($message->email)->send(new ContactReplyMail($message));
    }
}

