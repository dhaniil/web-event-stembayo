<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'nomer' => ['required', 'string', 'max:13'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'kelas' => ['nullable', 'string', 'max:255'],
            'jurusan' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'nomer' => $request->nomer,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
            ]);

            // Assign default Pengunjung role
            $pengunjungRole = Role::where('name', 'Pengunjung')->first();
            if ($pengunjungRole) {
                $user->assignRole($pengunjungRole);
            }

            // Log registration success
            activity()
                ->useLog('authentication')
                ->causedBy($user)
                ->event('register')
                ->withProperties([
                    'name' => $user->name,
                    'email' => $user->email,
                    'kelas' => $user->kelas,
                    'jurusan' => $user->jurusan,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ])
                ->log('User baru berhasil registrasi');

            event(new Registered($user));

            Auth::login($user);

            return redirect('/home');

        } catch (\Exception $e) {
            // Log registration failure
            activity()
                ->useLog('authentication')
                ->event('register_failed')
                ->withProperties([
                    'email' => $request->email,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'error' => $e->getMessage()
                ])
                ->log('Registrasi user gagal');

            throw $e;
        }
    }
}
