<!DOCTYPE html>
<html>
<head>
    <title>Buat Laporan</title>
</head>
<body>

<h2>Buat Laporan</h2>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('siswa.laporan.store') }}" method="POST">
    @csrf

    <label>Fasilitas</label><br>
    <select name="fasilitas_id" required>
        <option value="">-- Pilih Fasilitas --</option>
        @foreach($fasilitas as $item)
            <option value="{{ $item->id }}">{{ $item->nama_fasilitas }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Teknisi (Opsional)</label><br>
    <select name="teknisi_id">
        <option value="">-- Belum Ditentukan --</option>
        @foreach($teknisi as $t)
            <option value="{{ $t->id }}">{{ $t->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Tingkat Urgency</label><br>
    <select name="tingkat_urgency" required>
        <option value="rendah">Rendah</option>
        <option value="sedang">Sedang</option>
        <option value="tinggi">Tinggi</option>
    </select>
    <br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi" rows="4" required></textarea>
    <br><br>

    <button type="submit">Kirim Laporan</button>
    <a href="{{ route('riwayatlaporan.index') }}">Kembali</a>
</form>

</body>
</html>
