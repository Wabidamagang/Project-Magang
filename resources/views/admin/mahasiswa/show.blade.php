@extends('admin.layout.appadmin')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Mahasiswa</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $mahasiswa->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $mahasiswa->name }}</p>
            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
            <p><strong>Kelas:</strong> {{ $mahasiswa->kelas ? $mahasiswa->kelas->name : 'Tidak Ada Kelas' }}</p>
            <p><strong>Tempat Lahir:</strong> {{ $mahasiswa->tempat_lahir }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $mahasiswa->tanggal_lahir }}</p>
            <a href="{{ url('admin/mahasiswa') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@endsection
