@extends('admin.layout.appadmin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Request</h1>

    <!-- DataTales Example -->
    <div class="card-header py-3 d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Table Request</h6>
    </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1 @endphp
                    @foreach ($request as $rq)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{ $rq->mahasiswa->name }}</td>
                            <td>{{ $rq->keterangan }}</td>
                            <td>
                            <a href="{{ route('request.approve', $rq->id) }}" class="btn btn-success">Setuju</a>
                            <a href="{{ route('request.reject', $rq->id) }}" class="btn btn-danger">Tolak</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection