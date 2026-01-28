<?php

namespace App\Http\Controllers;

class PaymentController extends Controller
{
    /**
     * Display the payment page (placeholder - no gateway integration yet).
     */
    public function index()
    {
        return view('pages.payment');
    }
}

