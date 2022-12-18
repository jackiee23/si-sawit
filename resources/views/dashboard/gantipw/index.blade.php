@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Ganti Password</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/user/{{$admin->id}}">
                    @method('patch');
                    @csrf
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Password Lama</label>
                        <input type="password" autocomplete="off" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password">
                            @error('old_password')
                            <div class="invalid-feedback">
                                Password salah, harus memiliki setidaknya 6 huruf.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
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
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
