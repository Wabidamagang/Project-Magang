@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Menambah Data Kelas</h1>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{url('admin/kelas/store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" 
                           class="form-control" 
                           placeholder="Masukkan Name" required>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah" class="block text-gray-700 text-sm font-bold mb-2">Jumlah</label>
                    <input type="text" id="jumlah" name="jumlah" 
                           class="form-control" 
                           placeholder="Masukkan Jumlah" required>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="btn btn-primary">
                        Create
                    </button>
                    <a class="btn btn-secondary" href="{{ url('admin/kelas') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
