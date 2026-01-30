<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Admin Middleware
 * Design Pattern: Chain of Responsibility - memvalidasi request sebelum mencapai controller
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Memastikan user sudah login, aktif, dan memiliki role admin/owner
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access admin panel.');
        }

        $user = Auth::user();

        if (!$user->isActive()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->with('error', 'Your account is inactive.');
        }

        if (!$user->isAdmin() && !$user->isOwner()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('home')->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}