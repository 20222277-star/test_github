<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showDashboard()
    {
        $user = Auth::user();
        
        if ($user->role_id == 1) {
            // Admin dashboard
            return view('dashboard.admin');
        } elseif ($user->role_id == 2) {
            // Teacher dashboard
            return view('dashboard.teacher');
        } else {
            // Student dashboard
            return view('dashboard.student');
        }
    }
}
