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

<form action="{{ route('laporan.store') }}" method="POST">
    @csrf

    <label>Fasilitas</label><br>
    <select name="fasilitas_id">
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
            <option value="{{ $t->id }}">{{ $t->nama }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Tingkat Urgency</label><br>
    <select name="tingkat_urgency">
        <option value="rendah">Rendah</option>
        <option value="sedang">Sedang</option>
        <option value="tinggi">Tinggi</option>
    </select>
    <br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi" rows="4"></textarea>
    <br><br>

    <button type="submit">Kirim Laporan</button>
    <a href="{{ route('laporan.index') }}">Kembali</a>
</form>

</body>
</html>
