@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pinjaman</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
            <div class="flash-data" data-flashdata="{{session('status')}} "></div>
                {{-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> --}}
            @endif
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Data admin</h6> --}}
                <a href="/dashboard/loan/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Pinjaman</th>
                                <th>Jenis Pinjaman</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loan as $loan )
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$loan->nama}} </td>
                                <td> {{$loan->tgl}} </td>
                                <td> {{$loan->jenis_pinjaman}} </td>
                                <td> Rp.{{number_format($loan->nilai,2,',','.')}}</td>
                                <td> {{$loan->keterangan}} </td>
                                <td class="text-center">
                                    <a href="/dashboard/loan/{{$loan->id}}/edit/"><i class="fas fa-edit text-success"></i></a>
                                    <form id="formHapus" action="/dashboard/loan/{{ $loan->id }} " method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="fas fa-trash text-danger border-0 tombol-hapus"></button>
                                    </form>
                                    {{-- <a href="!"><i class="fas fa-trash text-danger"></i></a> --}}
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
