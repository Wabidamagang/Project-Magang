@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mengedit Data Kaprodi</h1>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{url('admin/kaprodi/update', $kaprodi->id)}}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <!-- Kode Dosen -->
                <div class="mb-3">
                    <label for="kode_dosen" class="block text-gray-700 text-sm font-bold mb-2">Kode Dosen</label>
                    <input type="text" id="kode_dosen" name="kode_dosen" 
                           class="form-control" 
                           value="{{ $kaprodi->kode_dosen }}">
                </div>

                <!-- NIP -->
                <div class="mb-3">
                    <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">NIP</label>
                    <input type="text" id="nip" name="nip" 
                           class="form-control" 
                           value="{{ $kaprodi->nip }}">
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" 
                           class="form-control" 
                           value="{{ $kaprodi->name }}">
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="btn btn-primary">
                        Update
                    </button>
                    <a class="btn btn-secondary" href="{{ url('admin/kaprodi') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection
