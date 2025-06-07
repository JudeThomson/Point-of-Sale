<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); 
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('login')->attempt(['staff_id' => $request->staff_id, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'error' => 'Invalid login credentials.',
        ]);

    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('login')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

