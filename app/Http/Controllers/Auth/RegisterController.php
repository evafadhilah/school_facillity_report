<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'siswa',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}
