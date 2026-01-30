<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\ContactMessageService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected ContactMessageService $contactMessageService
    ) {
    }

    /**
     * Display the contact page.
     */
    public function index(): View
    {
        $settings = Setting::getShopSettings();
        return view('pages.contact', compact('settings'));
    }

    /**
     * Handle contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Simpan ke database agar bisa dibaca dan dibalas dari panel admin
        $this->contactMessageService->storeFromRequest($request);

        return back()->with('success', 'Terima kasih, pesan Anda sudah terkirim. Admin akan membalas melalui email Anda.');
    }
}