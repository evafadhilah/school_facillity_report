<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan</title>
</head>
<body>

<h2>Detail Laporan</h2>

<p><strong>Pelapor:</strong> {{ $laporan->pelapor->nama }}</p>
<p><strong>Fasilitas:</strong> {{ $laporan->fasilitas->nama_fasilitas }}</p>
<p><strong>Teknisi:</strong> {{ $laporan->teknisi->nama ?? '-' }}</p>
<p><strong>Urgency:</strong> {{ ucfirst($laporan->tingkat_urgency) }}</p>
<p><strong>Status:</strong> {{ ucfirst($laporan->status) }}</p>
<p><strong>Deskripsi:</strong><br>{{ $laporan->deskripsi }}</p>

<hr>

<h3>Riwayat Status</h3>

@if($laporan->riwayat->count())
    <ul>
        @foreach($laporan->riwayat as $riwayat)
            <li>
                <strong>{{ ucfirst($riwayat->status) }}</strong>
                - {{ $riwayat->created_at->format('d M Y H:i') }}<br>
                Catatan: {{ $riwayat->catatan ?? '-' }}
            </li>
        @endforeach
    </ul>
@else
    <p>Belum ada riwayat.</p>
@endif

<br>

<a href="{{ route('laporan.index') }}">Kembali</a>
<a href="{{ route('laporan.edit', $laporan->id) }}">Edit</a>

</body>
</html>
