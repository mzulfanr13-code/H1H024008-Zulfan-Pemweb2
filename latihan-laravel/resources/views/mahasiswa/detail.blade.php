@extends('layouts.app')

@section('judul', 'Detail Mahasiswa')

@section('konten')
    <h1 class="h3 mb-4">Detail Mahasiswa</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
            <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
            <p><strong>Program Studi:</strong> {{ $mahasiswa->programStudi->nama }}</p>
        </div>
    </div>

    <h4 class="mb-3">Mata Kuliah yang Diambil</h4>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa->matakuliahs as $mk)
            <tr>
                <td>{{ $mk->kode }}</td>
                <td>{{ $mk->nama }}</td>
                <td>{{ $mk->sks }}</td>
                {{-- Untuk mengambil data dari tabel pivot, gunakan ->pivot --}}
                <td><strong>{{ $mk->pivot->nilai }}</strong></td> 
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('mahasiswa.data') }}" class="btn btn-secondary">Kembali</a>
@endsection