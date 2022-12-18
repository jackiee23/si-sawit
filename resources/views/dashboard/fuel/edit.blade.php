@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Bahan Bakar</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/fuel/{{$fuel->id}} ">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_pengisian" class="form-label">Tanggal Pengisian</label>
                        <input type="date" class="form-control @error('tgl_pengisian') is-invalid @enderror" id="tgl_pengisian"
                            name="tgl_pengisian" value="{{ old('tgl_pengisian', $fuel->tgl_pengisian) }}">
                        @error('tgl_pengisian')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="car_id" class="form-label">Nama Mobil</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="car_id" id="car_id">
                            <option value="{{$fuel->car_id}} " selected>{{$fuel->car->nama_kendaraan}}</option>
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
                        <label for="jumlah_liter" class="form-label">Jumlah Liter</label>
                        <input type="text" class="form-control @error('jumlah_liter') is-invalid @enderror"
                            id="jumlah_liter" name="jumlah_liter" value="{{ old('jumlah_liter', $fuel->jumlah_liter) }} "
                            >
                        @error('jumlah_liter')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Per Liter</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" value="{{ old('harga', $fuel->harga) }} " >
                        @error('harga')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            name="keterangan" value="{{ old('keterangan', $fuel->keterangan) }} " >
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
