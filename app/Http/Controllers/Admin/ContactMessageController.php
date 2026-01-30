<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ContactMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller untuk mengelola pesan dari halaman Hubungi Kami.
 * Design pattern: Controller tipis, logika bisnis dipindah ke Service.
 */
class ContactMessageController extends Controller
{
    public function __construct(
        protected ContactMessageService $service
    ) {
    }

    /**
     * Tampilkan daftar pesan kontak.
     */
    public function index(Request $request): View
    {
        $query = ContactMessage::query()->latest();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $messages = $query->paginate(15);

        return view('admin.messages.index', [
            'messages' => $messages,
        ]);
    }

    /**
     * Detail satu pesan + form balasan.
     */
    public function show(ContactMessage $message): View
    {
        $this->service->markAsRead($message);

        return view('admin.messages.show', [
            'message' => $message->fresh(),
        ]);
    }

    /**
     * Proses balasan pesan oleh admin.
     */
    public function reply(Request $request, ContactMessage $message): RedirectResponse
    {
        $validated = $request->validate([
            'reply_message' => ['required', 'string', 'max:2000'],
        ]);

        $admin = $request->user();

        $this->service->reply($message, $admin, $validated['reply_message']);

        return redirect()
            ->route('admin.contact-messages.show', $message)
            ->with('success', 'Balasan berhasil dikirim ke email pengguna.');
    }
}

