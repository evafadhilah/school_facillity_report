@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Riwayat Laporan</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Laporan</th>
                <th>Judul Laporan</th>
                <th>Teknisi</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatLaporans as $riwayat)
                <tr>
                    <td>{{ $riwayat->laporan->id }}</td>
                    <td>{{ $riwayat->laporan->judul ?? '-' }}</td>
                    <td>{{ $riwayat->teknisi->name ?? '-' }}</td>
                    <td>{{ $riwayat->catatan ?? '-' }}</td>
                    <td>{{ ucfirst($riwayat->status) }}</td>
                    <td>{{ $riwayat->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada riwayat laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
