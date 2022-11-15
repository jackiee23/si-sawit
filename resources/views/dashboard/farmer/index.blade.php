@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Petani</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
            <div class="flash-data" data-flashdata="{{session('status')}} "></div>
                {{-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> --}}
            @endif
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Data Petani</h6> --}}
                <a href="/dashboard/farmer/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No WA</th>
                                <th>Luas Kebun (Ha)</th>
                                <th>Jarak TPH ke Kebun</th>
                                <th>Umur Kebun</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petani as $ptn)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $ptn->nama }} </td>
                                    <td> {{ $ptn->alamat }} </td>
                                    <td> {{ $ptn->no_wa }} </td>
                                    <td> {{ $ptn->luas }} </td>
                                    <td> {{ $ptn->jarak }} </td>
                                    <td> {{ $ptn->umur }} </td>
                                    <td class="text-center">
                                        <a href="/dashboard/farmer/{{ $ptn->id }}/edit/"><i
                                                class="fas fa-edit text-success"></i></a>
                                        <form id="formHapus" action="/dashboard/farmer/{{ $ptn->id }} " method="post" class="d-inline" >
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="fas fa-trash text-danger border-0 tombol-hapus"></button>
                                        </form>
                                        {{-- <a href="/farmer/{{$ptn->id}}"><i class="fas fa-trash text-danger"></i></a> --}}
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
