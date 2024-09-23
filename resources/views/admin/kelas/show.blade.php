@extends('admin.layout.appadmin')

@section('content')
<div class="container-fluid">
    <h1>{{ $kelas->name }}</h1>

    <br>
    <h2>Plot Dosen dan Mahasiswa:</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Nama Dosen</th>
                    <th>Nama Mahasiswa</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach($kelas->dosen as $dosen)
                    @foreach($dosen->mahasiswaPivot ?? [] as $mahasiswa)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $kelas->name }}</td>
                            <td>{{ $dosen->name }}</td>
                            <td>{{ $mahasiswa->name }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
