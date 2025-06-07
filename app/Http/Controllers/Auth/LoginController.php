<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;

class LoginController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('login'); 
    // }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required',
            'password' => 'required',
        ]);

        $login = Login::where('staff_id', $validated['staff_id'])->first();

        if (!$login || !Hash::check($validated['password'], $login->password)) {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }

        // Log in the user
        session(['staff_id' => $login->staff_id]);

        return view('dashboard');
    }
    
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Login successful');
    }

}