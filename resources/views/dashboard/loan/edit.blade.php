@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Pinjaman</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/loan/{{$loan->id}} ">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputnama"
                            name="nama" placeholder="Masukkan Nama Peminjam" value="{{old('nama',$loan->nama)}} ">
                            @error('nama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Pinjaman</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl" value="{{old('tgl', $loan->tgl)}}">
                            @error('tgl')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman</label>
                        <input type="text" class="form-control @error('jenis_pinjaman') is-invalid @enderror" id="jenis_pinjaman" name="jenis_pinjaman" value="{{old('jenis_pinjaman', $loan->jenis_pinjaman)}} "
                            placeholder="Masukkan Jenis Pinjaman">
                            @error('jenis_pinjaman')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Pinjaman</label>
                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{old('nilai', $loan->nilai)}} "
                            placeholder="Masukkan Nilai Pinjaman">
                            @error('nilai')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Pinjaman</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{old('keterangan', $loan->keterangan)}} "
                            placeholder="Masukkan Keterangan Pinjaman">
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
