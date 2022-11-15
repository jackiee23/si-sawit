@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Pembelian</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data loan</h6>
                <button class="btn btn-info">Tambah Data</button>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="/purchase">
                    @csrf
                    <div class="mb-3">
                        <label for="farmer_id" class="form-label">Nama Petani</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="farmer_id" id="farmer_id">
                            <option value="" selected>Pilih nama petani</option>
                            @foreach ($farmers as $farmer)
                            <option value="{{$farmer->id}}" {{ old('farmer_id') == $farmer->id ? 'selected' : '' }}>{{$farmer->nama}}</option>
                            @endforeach
                        </select>
                        @error('farmer_id')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="tgl_beli" class="form-label">Tanggal Pembelian</label>
                        <input type="date" class="form-control @error('tgl_beli') is-invalid @enderror" id="tgl_beli"
                            name="tgl_beli" value="{{ old('tgl_beli') }}">
                        @error('tgl_beli')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_sawit" class="form-label">Jumlah Sawit</label>
                        <input type="text" class="form-control @error('jumlah_sawit') is-invalid @enderror"
                            id="jumlah_sawit" name="jumlah_sawit" value="{{ old('jumlah_sawit') }} "
                            >
                        @error('jumlah_sawit')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" value="{{ old('harga') }} " >
                        @error('harga')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="worker_id" class="form-label">Nama Pekerja</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="worker_id" id="worker_id">
                            <option value="" selected>Pilih nama pekerja</option>
                            @foreach ($workers as $worker)
                            <option value="{{$worker->id}}" {{old('worker_id') == $worker->id ? 'selected' : ''}} >{{$worker->nama}}</option>
                            @endforeach
                        </select>
                        @error('worker')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="car_id" class="form-label">Nama Kendaraan</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="car_id" id="car_id">
                            <option value="" selected>Pilih nama kendaraan</option>
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
                        <label for="trip" class="form-label">Jumlah Trip</label>
                        <input type="text" class="form-control @error('trip') is-invalid @enderror" id="trip"
                            name="trip" value="{{ old('trip') }} ">
                        @error('trip')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            name="keterangan" value="{{ old('keterangan') }} " >
                        @error('keterangan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
