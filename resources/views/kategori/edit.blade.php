<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>

<h2>Edit Kategori</h2>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"><br><br>

    <button type="submit">Update</button>
    <a href="{{ route('kategori.index') }}">Kembali</a>
</form>

</body>
</html>
