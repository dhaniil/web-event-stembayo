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
}
