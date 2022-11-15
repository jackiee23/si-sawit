@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Penjualan</h1>

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
                <a href="/sale/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Jual</th>
                                <th>Jumlah Sawit(Kg)</th>
                                <th>Harga Pabrik</th>
                                <th>Omset Penjualan</th>
                                <th>Nama Pekerja</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale as $sale )
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$sale->tgl_jual}} </td>
                                <td> {{$sale->jumlah}} </td>
                                <td> Rp.{{number_format($sale->harga_pabrik,2,',','.')}} </td>
                                <td> Rp.{{number_format($sale->jumlah*$sale->harga_pabrik,2,',','.')}} </td>
                                <td> {{$sale->worker->nama}} </td>
                                <td> {{$sale->keterangan}} </td>
                                <td class="text-center">
                                    <a href="/sale/{{$sale->id}}/edit/"><i class="fas fa-edit text-success"></i></a>
                                    <form id="formHapus" action="/sale/{{ $sale->id }} " method="post" class="d-inline">
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
