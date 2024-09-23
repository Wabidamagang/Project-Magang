@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Menambah Data Mahasiswa</h1>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{url('admin/mahasiswa/store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form-group">
                    <label for="kelas_id">Kelas:</label>
                    <select name="kelas_id" id="kelas_id" class="form-control">
                        @foreach($kelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIM -->
                <div class="mb-3">
                    <label for="nim" class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                    <input type="text" id="nim" name="nim" 
                           class="form-control" 
                           placeholder="Masukkan NIM" required>
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" 
                           class="form-control" 
                           placeholder="Masukkan Name" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-3">
                    <label for="tempat_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" 
                           class="form-control" 
                           placeholder="Masukkan Tempat Lahir" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-3">
                    <label for="tanggal_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" 
                           class="form-control" 
                           placeholder="Masukkan Tanggal Lahir" required>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="btn btn-primary">
                        Create
                    </button>
                    <a class="btn btn-secondary" href="{{ url('admin/mahasiswa') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
