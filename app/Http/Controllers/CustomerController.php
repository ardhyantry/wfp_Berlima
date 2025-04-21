<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //eloquent
        $customers = User::all();
        //filter role 
        $customers = $customers->filter(function ($customer) {
            return $customer->role == 'customer';
        });
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $validated = $request->validate([
            'name'         => 'required|string|max:50',
            'email'        => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:25',
            'username'     => 'required|string|max:45|unique:users,username',
            'password'     => 'required|string|min:6',
        ]);

        //create user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'phone_number' => $validated['phone_number'],
            'username' => $validated['username'],
            'role' => 'customer',
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.customers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.customers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
    
        $user->delete();

        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus!');
    }
}
