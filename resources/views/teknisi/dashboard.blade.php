<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.backend')

@section('content')
<h1>Dashboard Admin</h1>
<p>Selamat datang, {{ auth()->user()->name }}!</p>
@endsection
