@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Pembelian</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data loan</h6>
                <button class="btn btn-info">Tambah Data</button>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="/sale/{{$sale->id}}">
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
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="worker_id" class="form-label">Nama Pekerja</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="worker_id" id="worker_id">
                            <option value="{{$sale->worker_id}} " selected>{{$sale->worker->nama}}</option>
                            @foreach ($worker as $worker)
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
                        <label for="jumlah" class="form-label">Jumlah Sawit</label>
                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                            id="jumlah" name="jumlah" value="{{ old('jumlah', $sale->jumlah) }} "
                            placeholder="Masukkan Jumlah Sawit">
                        @error('jumlah')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="harga_pabrik" class="form-label">Harga Pabrik</label>
                        <input type="text" class="form-control @error('harga_pabrik') is-invalid @enderror" id="harga"
                            name="harga_pabrik" value="{{ old('harga_pabrik', $sale->harga_pabrik) }} " placeholder="Masukkan Harga Pabrik">
                        @error('harga_pabrik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
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
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
