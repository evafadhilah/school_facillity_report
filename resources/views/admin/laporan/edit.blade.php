<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan</title>
</head>
<body>

<h2>Edit Laporan</h2>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Fasilitas</label><br>
    <select name="fasilitas_id">
        @foreach($fasilitas as $item)
            <option value="{{ $item->id }}"
                {{ $laporan->fasilitas_id == $item->id ? 'selected' : '' }}>
                {{ $item->nama_fasilitas }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Teknisi</label><br>
    <select name="teknisi_id">
        <option value="">-- Tidak Ada --</option>
        @foreach($teknisi as $t)
            <option value="{{ $t->id }}"
                {{ $laporan->teknisi_id == $t->id ? 'selected' : '' }}>
                {{ $t->nama }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Status</label><br>
    <select name="status">
        @foreach(['pending','ditugaskan','diproses','selesai','ditolak'] as $status)
            <option value="{{ $status }}"
                {{ $laporan->status == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Update</button>
    <a href="{{ route('laporan.index') }}">Kembali</a>
</form>

</body>
</html>
