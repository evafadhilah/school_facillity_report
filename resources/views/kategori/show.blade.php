<!DOCTYPE html>
<html>
<head>
    <title>Detail Kategori</title>
</head>
<body>

<h2>Detail Kategori</h2>

<p>
    <strong>Nama Kategori:</strong><br>
    {{ $kategori->nama_kategori }}
</p>

<a href="{{ route('kategori.index') }}">Kembali</a>
<a href="{{ route('kategori.edit', $kategori->id) }}">Edit</a>

</body>
</html>
