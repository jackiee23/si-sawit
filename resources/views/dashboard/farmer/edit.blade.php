@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Petani</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Petani</h6>
                <button class="btn btn-info">Tambah Data</button>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="/dashboard/farmer/{{$farmer->id}}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputnama"
                            name="nama" placeholder="Masukkan Nama Petani" value="{{old('nama', $farmer->nama)}} ">
                            @error('nama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3" name="alamat">{{old('alamat', $farmer->alamat)}}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WA</label>
                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{old('no_wa', $farmer->no_wa)}} "
                            placeholder="Masukkan Nomer WA">
                            @error('no_wa')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="luas" class="form-label">Luas Kebun (Ha)</label>
                        <input type="text" class="form-control @error('luas') is-invalid @enderror" id="luas" name="luas" value="{{old('luas', $farmer->luas)}} "
                            placeholder="Masukkan Luas Kebun">
                            @error('luas')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="jarak" class="form-label">Jarak TPH ke Kebun</label>
                        <input type="text" class="form-control @error('jarak') is-invalid @enderror" id="jarak" name="jarak" value="{{old('jarak', $farmer->jarak)}} "
                            placeholder="Masukkan Jarak">
                            @error('jarak')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                        <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="umur" class="form-label">Umur Kebun</label>
                        <input type="text" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{old('umur', $farmer->umur)}} "
                            placeholder="Masukkan Umur Kebun">
                            @error('umur')
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
