@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-bold text-gray-700">Total Laporan</h2>
        <p class="text-2xl">{{ $total }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-bold text-gray-700">Pending</h2>
        <p class="text-2xl text-yellow-500">{{ $pending }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-bold text-gray-700">Selesai</h2>
        <p class="text-2xl text-green-500">{{ $selesai }}</p>
    </div>
</div>
@endsection
