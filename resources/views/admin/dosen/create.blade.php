@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Menambah Data Dosen</h1>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{url('admin/dosen/store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <!-- Kode Dosen -->
                <div class="mb-3">
                    <label for="kode_dosen" class="block text-gray-700 text-sm font-bold mb-2">Kode Dosen</label>
                    <input type="text" id="kode_dosen" name="kode_dosen" 
                           class="form-control" 
                           placeholder="Masukkan Kode Dosen" required>
                </div>

                <!-- NIP -->
                <div class="mb-3">
                    <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">NIP</label>
                    <input type="text" id="nip" name="nip" 
                           class="form-control" 
                           placeholder="Masukkan NIP" required>
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" 
                           class="form-control" 
                           placeholder="Masukkan Nama" required>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="btn btn-primary">
                        Create
                    </button>
                    <a class="btn btn-secondary" href="{{ url('admin/dosen') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
