<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests; // Menambahkan trait ini
    
    public function index()
    {
        // Authorize access using the gate
        $this->authorize('admin-access');

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Authorize access using the gate
        $this->authorize('admin-access');

        return view('users.create');
    }

    public function store(Request $request)
    {
        // Authorize access using the gate
        $this->authorize('admin-access');

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,sekbid', // Only admin or sekbid
        ]);

        User::create($validatedData);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        // Authorize access using the gate
        $this->authorize('admin-access');

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Authorize access using the gate
        $this->authorize('admin-access');

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:admin,sekbid',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        // Authorize access using the gate
        $this->authorize('admin-access');

        User::findOrFail($id)->delete();
        return redirect()->route('users.index');
    }

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

}
