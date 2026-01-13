<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::guard('web')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}
