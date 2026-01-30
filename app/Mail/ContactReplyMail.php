<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Email balasan untuk pesan kontak.
 * Design pattern: Mailable (Laravel).
 */
class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageModel;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactMessage $message)
    {
        $this->messageModel = $message;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this
            ->subject('Balasan Pesan Anda - Wesclic Coffee Shop')
            ->view('emails.contact_reply');
    }
}

