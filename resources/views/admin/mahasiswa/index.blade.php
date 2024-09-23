@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Mahasiswa</h1>

    <!-- DataTales Example -->
    <div class="card-header py-3 d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Table Mahasiswa</h6>
    @if (auth()->user()->role === 'dosen')
    <a href="{{url('admin/mahasiswa/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    @endif
    </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Kelas</th>
                            <th>NIM</th>
                            <th>Name</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Edit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1 @endphp
                    @foreach ($mahasiswa as $ms)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{ $ms->kelas ? $ms->kelas->name : 'Tidak Ada Kelas' }}</td>
                            <td>{{$ms->nim}}</td>
                            <td>{{$ms->name}}</td>
                            <td>{{$ms->tempat_lahir}}</td>
                            <td>{{$ms->tanggal_lahir}}</td>
                            <td>
                            <!-- Mahasiswa login sesuai user id-nya -->
                            @if (auth()->user()->id == $ms->user_id)
                            @if ($ms->edit == 0)
                                <!-- Mahasiswa belum minta akses -->
                                <form action="{{ route('request.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="mahasiswa_id" value="{{ $ms->id }}">
                                    <button type="submit" class="btn btn-primary">Minta Akses Edit</button>
                                </form>
                            @elseif ($ms->edit == 1)
                                <!-- Mahasiswa memiliki akses untuk mengedit -->
                                <p>Anda sudah memiliki akses untuk mengedit data.</p>
                                <a href="{{ url('admin/mahasiswa/edit', $ms->id) }}" class="btn btn-sm btn-warning" style="margin-right: 5px;">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                            @elseif ($ms->edit == 2)
                                <!-- Mahasiswa telah selesai mengedit -->
                                <p>Data sudah diperbarui.</p>
                            @elseif ($ms->edit == -1)
                                <!-- Permintaan ditolak -->
                                <p>Maaf, permintaan akses edit Anda telah ditolak. Anda tidak bisa mengedit data.</p>
                            @endif
                            @else
                            <!-- Jika mahasiswa bukan pemilik data, tidak tampilkan tombol -->
                            <p>-</p>
                            @endif
                            </td>
                            <td>
                            @if (auth()->user()->role === 'dosen')
                            <a href="{{url('admin/mahasiswa/show/'.$ms->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ url('admin/mahasiswa/edit', $ms->id) }}" class="btn btn-sm btn-warning" style="margin-right: 5px;">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                            
                                <!-- Button Hapus Data -->
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$ms->id}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$ms->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin akan menghapus data {{$ms->name}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="{{url('admin/mahasiswa/delete/'.$ms->id)}}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
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