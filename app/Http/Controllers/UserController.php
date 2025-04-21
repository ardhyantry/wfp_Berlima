<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.customers.index', compact('users'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:50',
            'email'        => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:25',
            'username'     => 'required|string|max:45|unique:users,username',
            'password'     => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.customers.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.customers.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:50',
            'email'        => 'required|email|unique:users,email,'.$id,
            'phone_number' => 'required|string|max:25',
            'username'     => 'required|string|max:45|unique:users,username,'.$id,
            'password'     => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
