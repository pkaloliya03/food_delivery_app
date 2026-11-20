<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('owner.auth');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:master_users,username',
            'email' => 'required|email|max:150|unique:master_users,email',
            'mobile' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Users::create([
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
            'role' => 'restaurant_owner',
            'status' => true,
        ]);

        Auth::login($user);

        return redirect()->route('owner.dashboard')
            ->with('success', 'Registration successful. Welcome!');
    }

    public function showLogin()
    {
        return view('owner.auth');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'status' => true,
        ])) {
            $request->session()->regenerate();

            return redirect()->route('owner.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}
