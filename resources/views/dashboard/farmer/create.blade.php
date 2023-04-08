@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Petani</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/farmer">
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputnama"
                            name="nama" placeholder="Masukkan Nama Petani" value="{{old('nama')}} ">
                            @error('nama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3" name="alamat">{{old('alamat')}}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WA</label>
                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{old('no_wa')}} "
                            placeholder="Masukkan Nomer WA">
                            @error('no_wa')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="luas" class="form-label">Luas Kebun (Ha)</label>
                        <input type="text" class="form-control @error('luas') is-invalid @enderror" id="luas" name="luas" value="{{old('luas')}} "
                            placeholder="Masukkan Luas Kebun">
                            @error('luas')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jarak" class="form-label">Jarak TPH ke Kebun</label>
                        <input type="text" class="form-control @error('jarak') is-invalid @enderror" id="jarak" name="jarak" value="{{old('jarak')}} "
                            placeholder="Masukkan Jarak">
                            @error('jarak')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="umur" class="form-label">Umur Tanaman Sawit</label>
                        <input type="text" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{old('umur')}} "
                            placeholder="Masukkan Umur Kebun">
                            @error('umur')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_tanah" class="form-label">Jenis Tanah</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="jenis_tanah" id="jenis_tanah">
                            <option value="" selected>Pilih jenis tanah</option>
                            <option value="Tanah Keras" {{old('jenis_tanah') ? 'selected' : ''}} >Tanah Keras</option>
                            <option value="Gambut" {{old('jenis_tanah') ? 'selected' : ''}} >Gambut</option>
                        </select>
                        @error('jenis_tanah')
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
