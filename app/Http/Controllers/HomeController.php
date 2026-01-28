<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman home default
    public function index()
    {
        return view('home'); // bisa ubah sesuai halaman home umum
    }

    // Halaman dashboard admin
    public function adminDashboard()
    {
        return view('admin.dashboard'); // pastikan file ini ada di resources/views/admin/dashboard.blade.php
    }

    // Halaman dashboard teknisi
    public function teknisiDashboard()
    {
        return view('teknisi.dashboard'); // pastikan file ini ada
    }
}
