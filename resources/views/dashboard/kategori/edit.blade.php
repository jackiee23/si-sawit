@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Kategori Pemeliharaan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data </h6>
                <button class="btn btn-info">Tambah Data</button>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="/dashboard/type/{{$type->id}}">
                    @method('patch');
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Kategori Pemeliharaan</label>
                        <input type="text" class="form-control @error('jenis_pemeliharaan') is-invalid @enderror" id="inputnama"
                            name="jenis_pemeliharaan" placeholder="Masukkan Kategori Pemeliharaan" value="{{old('jenis_pemeliharaan', $type->jenis_pemeliharaan)}} ">
                            @error('jenis_pemeliharaan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
