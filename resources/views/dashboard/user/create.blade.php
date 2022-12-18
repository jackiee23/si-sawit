@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Admin</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/user">
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputnama"
                            name="nama" placeholder="Masukkan Nama Admin" value="{{old('nama')}} ">
                            @error('nama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputemail" class="form-label">Email</label>
                        <input type="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" id="inputemail"
                            name="email" value="{{old('email')}} ">
                            @error('email')
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
                        <label for="jenis" class="form-label">Jenis Pekerjaan</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{old('jenis')}} "
                            placeholder="Masukkan Jenis Pekerjaan">
                            @error('jenis')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">
                                Password salah, harus memiliki setidaknya 6 huruf.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Masukan Ulang Password Anda</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password_confirmation">
                            @error('password')
                            <div class="invalid-feedback">
                                Password salah, harus memiliki setidaknya 6 huruf.
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
