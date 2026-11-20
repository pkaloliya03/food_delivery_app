<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Customer Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
            'role' => 'customer',
            'status' => true,
        ])) {

            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Welcome back!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid username or password.',
        ], 422);
    }


    /**
     * Customer Registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:master_users,username'],
            'email' => [
                'required',
                'email',
                'max:150',
                'unique:master_users,email',
            ],
            'mobile' => 'nullable|string|max:20',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = Users::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'] ?? null,
            'password' => $validated['password'],
            'role' => 'customer',
            'status' => true,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully.',
        ]);
    }


    /**
     * Customer Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Logged out successfully.'
            );
    }
}
