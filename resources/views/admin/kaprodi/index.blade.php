@extends('admin.layout.appadmin')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Kaprodi</h1>

                    <!-- DataTales Example -->
                    <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Table Kaprodi</h6>
                    <a href="{{url('admin/kaprodi/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Dosen</th>
                                            <th>NIP</th>
                                            <th>Name</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($kaprodi as $kp)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$kp->kode_dosen}}</td>
                                            <td>{{$kp->nip}}</td>
                                            <td>{{$kp->name}}</td>
                                            <td>
                                            <a href="{{url('admin/kaprodi/show/'.$kp->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{url('admin/kaprodi/edit',$kp->id)}}" class="btn btn-sm btn-warning" style="margin-right: 5px;"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <!-- Button Hapus Data -->
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$kp->id}}">
                                                  <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$kp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menghapus data {{$kp->name}} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="{{url('admin/kaprodi/delete/'.$kp->id)}}" type="button" class="btn btn-danger">Delete</a>
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

                </div>
                <!-- /.container-fluid -->

@endsection