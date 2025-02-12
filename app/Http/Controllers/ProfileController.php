<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profile
     */
    public function editProfile()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update data profile user
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'nomer' => ['nullable', 'string', 'max:15'],
            'kelas' => ['required', 'numeric', 'min:10', 'max:13'],
            'jurusan' => ['required', 'string', 'max:255']
        ]);

        try {
            foreach ($validated as $key => $value) {
                $user->$key = $value;
            }
            $user->save();

            return redirect()->back()
                        ->with('success', 'Data profile Anda berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                        ->with('error', 'Maaf, terjadi kesalahan saat memperbarui profile. Silakan coba lagi.');
        }
    }

    /**
     * Update foto profile
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'max:2048']
        ]);

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            
            $user->profile_picture = $path;
            $user->save();

            return redirect()->back()
                        ->with('success', 'Foto profile Anda berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                        ->with('error', 'Maaf, terjadi kesalahan saat memperbarui foto profile. Silakan coba lagi.');
        }
    }

    /**
     * Hapus foto profile
     */
    public function deleteProfilePicture()
    {
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
                
                $user->profile_picture = null;
                $user->save();
            }

            return redirect()->back()
                        ->with('success', 'Foto profile Anda berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                        ->with('error', 'Maaf, terjadi kesalahan saat menghapus foto profile. Silakan coba lagi.');
        }
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()->back()
                            ->withErrors(['current_password' => 'Password saat ini tidak sesuai'])
                            ->withInput();
            }

            // Update password - will be encrypted by setPasswordAttribute mutator
            $user->password = $validated['password'];
            $user->save();

            return redirect()->back()
                        ->with('success', 'Password Anda berhasil diperbarui. Gunakan password baru untuk login selanjutnya.');

        } catch (\Exception $e) {
            Log::error('Password update failed', [
                'user_id' => $user->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                        ->with('error', 'Maaf, terjadi kesalahan saat memperbarui password. Silakan coba lagi.');
        }
    }
}
