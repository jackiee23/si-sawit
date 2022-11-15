@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Perbaikan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data loan</h6>
                <button class="btn btn-info">Tambah Data</button>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="/repair/{{$repair->id}} ">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
                        <input type="date" class="form-control @error('tgl_perbaikan') is-invalid @enderror" id="tgl_perbaikan"
                            name="tgl_perbaikan" value="{{ old('tgl_perbaikan', $repair->tgl_perbaikan) }}">
                        @error('tgl_perbaikan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="car_id" class="form-label">Nama Mobil</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="car_id" id="car_id">
                            <option value="{{$repair->car_id}} " selected>{{$repair->car->nama_kendaraan}}</option>
                            @foreach ($car as $car)
                            <option value="{{$car->id}}" {{old('car_id') == $car->id ? 'selected' : ''}} >{{$car->nama_kendaraan}}</option>
                            @endforeach
                        </select>
                        @error('car_id')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kerusakan" class="form-label">Jenis Kerusakan</label>
                        <input type="text" class="form-control @error('jenis_kerusakan') is-invalid @enderror"
                            id="jenis_kerusakan" name="jenis_kerusakan" value="{{ old('jenis_kerusakan', $repair->jenis_kerusakan) }} "
                            placeholder="Masukkan Jumlah Liter">
                        @error('jenis_kerusakan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Biaya</label>
                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                            name="jumlah" value="{{ old('jumlah', $repair->jumlah) }} " placeholder="Masukkan jumlah biaya">
                        @error('jumlah')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            name="keterangan" value="{{ old('keterangan', $repair->keterangan) }} " placeholder="Tambah Keterangan">
                        @error('keterangan')
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