<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


        // Menambahkan metode untuk mengedit profil pengguna yang login
        public function updateProfile(Request $request)
        {
            $user = auth()->user();
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'kelas' => 'required|integer|between:10,13',
                'jurusan' => 'required|string|max:255',
                'nomer' => 'required|string|max:15',
            ]);
        
            // Kalau ada file PP baru maka diganti
            if ($request->hasFile('profile_picture')) {
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $validatedData['profile_picture'] = $imagePath;
            }
        
            // Update data pengguna
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->kelas = $validatedData['kelas'];
            $user->jurusan = $validatedData['jurusan'];
            $user->nomer = $validatedData['nomer'];
        
            // Kalau ada PP baru disimpan 
            if (isset($validatedData['profile_picture'])) {
                $user->profile_picture = $validatedData['profile_picture'];
            }
        
            $user->save();
        
            \Log::info('User profile updated:', $user->toArray());
        
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
        }
        
        
        
        public function updatePassword(Request $request)
        {
            $user = auth()->user();
            $validatedData = $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);
        
            $user->update([
                'password' => bcrypt($validatedData['password']),
            ]);
        
            \Log::info('User password updated:', ['user_id' => $user->id]);
        
            return redirect()->route('profile.edit')->with('success', 'Password updated successfully');
        }
        
        
        public function editProfile()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's profile picture.
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Delete old profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store new profile picture in public storage
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Update user profile picture path
        $user->profile_picture = $path;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile picture updated successfully');
    }

    /**
     * Delete the user's profile picture.
     */
    public function deleteProfilePicture()
    {
        $user = auth()->user();

        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profile picture deleted successfully');
    }
}