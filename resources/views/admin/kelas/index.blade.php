@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Kelas</h1>

    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Table Kelas</h6>
        <a href="{{ url('admin/kelas/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach ($kelas as $kl)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $kl->name }}</td>
                            <td>{{ $kl->mahasiswa->count() }}</td>
                            <td>
                                <a href="{{ url('admin/kelas/show/' . $kl->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('admin/kelas/edit/' . $kl->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('admin/kelas/' . $kl->id . '/plot') }}" class="btn btn-sm btn-success">
                                Plot
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $kl->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="exampleModal{{ $kl->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data {{ $kl->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="{{ url('admin/kelas/delete/' . $kl->id) }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection