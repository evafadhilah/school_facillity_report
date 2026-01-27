<!DOCTYPE html>
<html>
<head>
    <title>Tambah Riwayat Laporan</title>
</head>
<body>

<h3>Tambah Riwayat Laporan</h3>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('riwayat.store') }}" method="POST">
    @csrf

    {{-- laporan_id DIKIRIM TERSEMBUNYI --}}
    <input type="hidden" name="laporan_id" value="{{ $laporan->id }}">

    <label>Status</label><br>
    <select name="status">
        <option value="pending">Pending</option>
        <option value="ditugaskan">Ditugaskan</option>
        <option value="diproses">Diproses</option>
        <option value="selesai">Selesai</option>
        <option value="ditolak">Ditolak</option>
    </select>
    <br><br>

    <label>Catatan (Opsional)</label><br>
    <textarea name="catatan" rows="3"></textarea>
    <br><br>

    <button type="submit">Simpan Riwayat</button>
</form>

</body>
</html>
