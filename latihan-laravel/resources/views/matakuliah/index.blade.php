@extends('layouts.app')
@section('judul', 'Daftar Matakuliah')
@section('konten')
<h1 class="h3 mb-4">Daftar Matakuliah</h1>
<form action="{{ route('matakuliah.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <!-- Input name="q" akan menjadi parameter query string di URL -->
        <input type="text" name="q" class="form-control" placeholder="Cari nama matakuliah..." value="{{ $kataKunci ?? '' }}">
        <button class="btn btn-primary" type="submit">Cari</button>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>
<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Matakuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarMatakuliah as $mk)
        <tr>
            <td>{{ $mk['kode'] }}</td>
            <td>{{ $mk['nama'] }}</td>
            <td><x-badge-sks :sks="$mk['sks']" /></td>
            <td>
                <a href="{{ route('matakuliah.show', $mk['kode']) }}" class="btn btn-sm btn-primary">Detail</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Data matakuliah belum tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection