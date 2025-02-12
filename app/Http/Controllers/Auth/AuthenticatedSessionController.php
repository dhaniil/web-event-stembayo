<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Activitylog\Facades\LogActivity;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            // Log successful login
            activity()
                ->useLog('authentication')
                ->causedBy(Auth::user())
                ->event('login')
                ->withProperties([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ])
                ->log('User berhasil login');

            return redirect()->intended(route('events.dashboard', absolute: false));
        } catch (\Exception $e) {
            // Log failed login attempt
            activity()
                ->useLog('authentication')
                ->event('login_failed')
                ->withProperties([
                    'email' => $request->email,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ])
                ->log('Percobaan login gagal');

            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Log logout event
        activity()
            ->useLog('authentication')
            ->causedBy($user)
            ->event('logout')
            ->withProperties([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ])
            ->log('User telah logout');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
