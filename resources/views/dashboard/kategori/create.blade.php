@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Kategori Pemeliharaan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/type">
                    @csrf
                    <div class="mb-3">
                        <label for="inputjenis" class="form-label">Jenis Pemeliharaan</label>
                        <input type="text" class="form-control @error('jenis_pemeliharaan') is-invalid @enderror" id="inputjenis"
                            name="jenis_pemeliharaan" placeholder="Masukkan Jenis Pemeliharaan " value="{{old('jenis_pemeliharaan')}} ">
                            @error('jenis_pemeliharaan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
