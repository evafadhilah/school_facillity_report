<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return match (Auth::user()->role) {
                'admin'   => redirect()->route('admin.dashboard'),
                'teknisi' => redirect()->route('teknisi.dashboard'),
                'guru'    => redirect()->route('guru.laporan.index'),
                'siswa'   => redirect()->route('siswa.dashboard'),
                default   => $this->logoutWithError(),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    private function logoutWithError()
    {
        Auth::logout();
        return redirect()->route('login')->withErrors('Role tidak dikenali!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
