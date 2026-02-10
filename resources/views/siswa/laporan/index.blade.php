@extends('layouts.backend')

@section('title', 'Daftar Laporan Saya')

@section('content')
<a href="{{ route('siswa.laporan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Buat Laporan Baru</a>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="px-4 py-2">Judul</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $lap)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $lap->judul }}</td>
            <td class="px-4 py-2 capitalize">{{ $lap->status }}</td>
            <td class="px-4 py-2">{{ $lap->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
