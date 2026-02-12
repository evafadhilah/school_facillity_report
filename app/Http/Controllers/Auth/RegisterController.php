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
            'role' => 'required|in:siswa,guru', // ← TAMBAHAN INI
            'terms' => 'required', // ← TAMBAHAN INI (untuk checkbox terms)
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Pilih role terlebih dahulu',
            'role.in' => 'Role harus Siswa atau Guru',
            'terms.required' => 'Anda harus menyetujui kebijakan & ketentuan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // ← GANTI JADI DYNAMIC (bukan hardcode 'siswa')
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}
