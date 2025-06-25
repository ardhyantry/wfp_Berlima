<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function registerForm()
    {
    return view('auth.register'); // pastikan file ini ada di resources/views/auth/register.blade.php
    }

    public function register(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:45|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'phone_number' => 'required|string|max:25',
        'role' => ['required', 'in:admin,customer'], 
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('status', 'Register berhasil! Silakan login.');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended(route('public.home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function index(){}
    

    public function create(){}
    

    public function store(Request $request)
    {}

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
    }
}
