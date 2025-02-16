<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function editProfile()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'nomer' => ['required', 'string', 'max:13'],
            'kelas' => ['nullable', 'string'],
            'jurusan' => ['nullable', 'string']
        ]);

        DB::table('users')
            ->where('id', $user->id)
            ->update($request->only(['name', 'email', 'nomer', 'kelas', 'jurusan']));

        activity()
            ->useLog('user')
            ->causedBy($user)
            ->event('profile_update')
            ->withProperties($request->only(['name', 'email', 'nomer', 'kelas', 'jurusan']))
            ->log('User memperbarui profil');

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        activity()
            ->useLog('user')
            ->causedBy($user)
            ->event('password_update')
            ->log('User memperbarui password');

        return redirect()->back()->with('success', 'Password berhasil diperbarui');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'max:2048']
        ]);

        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'profile_picture' => $path
            ]);

        activity()
            ->useLog('user')
            ->causedBy($user)
            ->event('profile_picture_update')
            ->withProperties(['path' => $path])
            ->log('User memperbarui foto profil');

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui');
    }

    public function deleteProfilePicture()
    {
        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
            DB::table('users')
                ->where('id', $user->id)
                ->update(['profile_picture' => null]);

            activity()
                ->useLog('user')
                ->causedBy($user)
                ->event('profile_picture_delete')
                ->log('User menghapus foto profil');
        }

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus');
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        activity()
            ->useLog('user')
            ->causedBy($user)
            ->event('account_delete')
            ->log('User menghapus akun');

        Auth::logout();
        DB::table('users')->where('id', $user->id)->delete();

        return redirect('/');
    }

    public function updateKelasJurusan(Request $request)
    {
        $user = Auth::user();
        
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan
            ]);

        activity()
            ->useLog('user')
            ->causedBy($user)
            ->event('profile_update')
            ->withProperties([
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan
            ])
            ->log('User memperbarui profil');

        return redirect()->back()->with('success', 'Informasi kelas dan jurusan berhasil disimpan');
    }
}
