@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create New Entry</h1>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('kelas.plot', $kelas->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

    <div class="mb-3">
        <label for="dosen_id">Pilih Dosen</label>
        <select class="form-control" name="dosen_id" required>
                @foreach($dosen as $ds)
                    <option value="{{ $ds->id }}">{{ $ds->name }}</option>
                @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="mahasiswa_id">Pilih Mahasiswa</label>
        <select class="form-control" name="mahasiswa_id[]" multiple required>
                @foreach($mahasiswa as $ms)
                    <option value="{{ $ms->id }}">{{ $ms->name }}</option>
                @endforeach
        </select>
    </div>

    <!-- Tombol Submit -->
    <div class="flex justify-end">
                    <button type="submit" 
                            class="btn btn-primary">
                        Plot
                    </button>
                    <a class="btn btn-secondary" href="{{ url('admin/kelas') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection