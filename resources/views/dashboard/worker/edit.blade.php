@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Pekerja</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/worker/{{$worker->id}}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" value="{{old('nama', $worker->nama)}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputnik" class="form-label">No NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                            name="nik" value="{{old('nik', $worker->nik)}}">
                            @error('nik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3" name="alamat">{{old('alamat', $worker->alamat)}}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WA</label>
                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{old('no_wa', $worker->no_wa)}} ">
                            @error('no_wa')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Pekerjaan</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{old('jenis', $worker->jenis)}} "
                            >
                            @error('jenis')
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
