@extends('admin.layout.appadmin')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Kaprodi</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $kaprodi->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Kode Kaprodi:</strong> {{ $kaprodi->kode_dosen }}</p>
            <p><strong>NIP:</strong> {{ $kaprodi->nip }}</p>
            <p><strong>Name:</strong> {{ $kaprodi->name }}</p>
            <a href="{{ url('admin/kaprodi') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@endsection
