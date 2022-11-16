@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Kendaraan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
            <div class="flash-data" data-flashdata="{{session('status')}} "></div>
                {{-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> --}}
                @elseif (session('failed')){
                    <div class="failed-data" data-failed="{{ session('failed') }} "></div>
                }
            @endif
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Data admin</h6> --}}
                <a href="/dashboard/car/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kendaraan</th>
                                <th>Merek Kendaraan</th>
                                <th>Tanggal Beli</th>
                                <th>Keadaan Beli</th>
                                <th>Umur Kendaraan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car as $car )
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$car->nama_kendaraan}} </td>
                                <td> {{$car->merek}} </td>
                                <td> {{$car->tgl_beli}} </td>
                                <td> {{$car->keadaan_beli}} </td>
                                <td> {{$car->umur_kendaraan}} </td>
                                <td class="text-center">
                                    <a href="/dashboard/car/{{$car->id}}/edit/"><i class="fas fa-edit text-success"></i></a>
                                    <form id="formHapus" action="/dashboard/car/{{ $car->id }} " method="post" class="d-inline">
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
