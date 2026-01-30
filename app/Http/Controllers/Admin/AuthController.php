<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     * Design Pattern: Clear session before showing login form to prevent session conflicts
     */
    public function showLoginForm(): View
    {
        // Jika sudah login sebagai admin/owner, redirect ke dashboard
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isOwner())) {
            return redirect()->route('admin.dashboard');
        }

        // Clear any existing session data untuk mencegah konflik
        // Hanya clear jika user bukan admin/owner untuk menghindari logout yang tidak diinginkan
        if (Auth::check() && !Auth::user()->isAdmin() && !Auth::user()->isOwner()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        return view('admin.auth.login');
    }

    /**
     * Handle admin login.
     * Design Pattern: Proper session management dengan regenerate untuk keamanan
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Clear session sebelum attempt login untuk menghindari konflik
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            if (!$user->isActive()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Your account is inactive.'])->onlyInput('email');
            }

            if (!$user->isAdmin() && !$user->isOwner()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'You do not have permission to access admin panel.'])->onlyInput('email');
            }

            // Update last login
            $user->update(['last_login' => now()]);

            // Regenerate session ID untuk keamanan (prevent session fixation)
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }
}