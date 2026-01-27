<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>

<h2>Tambah Kategori</h2>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf

    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"><br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('kategori.index') }}">Kembali</a>
</form>

</body>
</html>
