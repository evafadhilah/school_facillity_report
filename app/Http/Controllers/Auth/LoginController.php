<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return match (Auth::user()->role) {
                'admin'   => redirect()->route('admin.dashboard'),
                'teknisi' => redirect()->route('teknisi.dashboard'),
                'guru'    => redirect()->route('guru.laporan.create'),
                'siswa'   => redirect()->route('siswa.laporan.create'),
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
        return redirect()->route('login')
            ->withErrors('Role tidak dikenali!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

