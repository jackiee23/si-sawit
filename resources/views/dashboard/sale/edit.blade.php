@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Pembelian</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/sale/{{$sale->id}}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_jual" class="form-label">Tanggal Penjualan</label>
                        <input type="date" class="form-control @error('tgl_jual') is-invalid @enderror" id="tgl_jual"
                            name="tgl_jual" value="{{ old('tgl_jual', $sale->tgl_jual) }}">
                        @error('tgl_jual')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="worker_id" class="form-label">Nama Pekerja</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="worker_id" id="worker_id">
                            <option value="{{$sale->worker_id}} " selected>{{$sale->worker->nama}}</option>
                            @foreach ($worker as $worker)
                            <option value="{{$worker->id}}" {{old('worker_id') == $worker->id ? 'selected' : ''}} >{{$worker->nama}}</option>
                            @endforeach
                        </select>
                        @error('worker_id')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Sawit</label>
                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                            id="jumlah" name="jumlah" value="{{ old('jumlah', $sale->jumlah) }} "
                            >
                        @error('jumlah')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_pabrik" class="form-label">Harga Pabrik</label>
                        <input type="text" class="form-control @error('harga_pabrik') is-invalid @enderror" id="harga"
                            name="harga_pabrik" value="{{ old('harga_pabrik', $sale->harga_pabrik) }} " >
                        @error('harga_pabrik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="car_id" class="form-label">Nama Kendaraan</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="car_id" id="car_id">
                            <option value="{{$sale->car_id}} " selected>{{$sale->car->nama_kendaraan}}</option>
                            @foreach ($car as $car)
                            <option value="{{$car->id}}" {{old('car_id') == $car->id ? 'selected' : ''}} >{{$car->nama_kendaraan}}</option>
                            @endforeach
                        </select>
                        @error('car_id')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pabrik" class="form-label">Nama Pabrik</label>
                        <input type="text" class="form-control @error('pabrik') is-invalid @enderror" id="pabrik"
                            name="pabrik" value="{{ old('pabrik', $sale->pabrik) }} " >
                        @error('pabrik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            name="keterangan" value="{{ old('keterangan', $sale->keterangan) }} " placeholder="Tambah Keterangan">
                        @error('keterangan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
