@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Kendaraan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data admin</h6>
                <button class="btn btn-info">Tambah Data</button>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="/car/{{$car->id}}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama Kendaraan</label>
                        <input type="text" class="form-control @error('nama_kendaraan') is-invalid @enderror" id="inputnama"
                            name="nama_kendaraan" placeholder="Masukkan Nama Kendaraan" value="{{old('nama_kendaraan', $car->nama_kendaraan)}} ">
                            @error('nama_kendaraan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="merek" class="form-label">Merek Kendaraan</label>
                        <input type="text" class="form-control @error('merek') is-invalid @enderror" id="merek" name="merek" value="{{old('merek', $car->merek)}} "
                            placeholder="Masukkan Merek Kendaraan">
                            @error('merek')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="tgl_beli" class="form-label">Tanggal Beli Kendaraan</label>
                        <input type="date" class="form-control @error('tgl_beli') is-invalid @enderror" id="tgl_beli" name="tgl_beli" value="{{old('tgl_beli', $car->tgl_beli)}}">
                            @error('tgl_beli')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="keadaan_beli" class="form-label">Kondisi Kendaraan</label>
                        <input type="text" class="form-control @error('keadaan_beli') is-invalid @enderror" id="keadaan_beli" name="keadaan_beli" value="{{old('keadaan_beli', $car->keadaan_beli)}} "
                            placeholder="Masukkan Kondisi Kendaraan">
                            @error('keadaan_beli')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="umur_kendaraan" class="form-label">Umur Kendaraan</label>
                        <input type="text" class="form-control @error('umur_kendaraan') is-invalid @enderror" id="umur_kendaraan" name="umur_kendaraan" value="{{old('umur_kendaraan', $car->umur_kendaraan)}} "
                            >
                            @error('umur_kendaraan')
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
