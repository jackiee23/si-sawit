@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Pengembalian Pinjaman</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/repayment">
                    @csrf
                    <div class="mb-3">
                        <label for="loan_id" class="form-label">Nama</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="loan_id" id="loan_id">
                            <option value="" selected>Pilih Nama</option>
                            @foreach ($loans as $loan)
                            <option value="{{$loan->id}}" {{ old('loan_id') == $loan->id ? 'selected' : '' }}>{{$loan->nama}}</option>
                            @endforeach
                        </select>
                            @error('loan_id')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl" value="{{old('tgl')}}">
                            @error('tgl')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman</label>
                        <input type="text" class="form-control @error('jenis_pinjaman') is-invalid @enderror" id="jenis_pinjaman" name="jenis_pinjaman" value="{{old('jenis_pinjaman')}} "
                            placeholder="Masukkan Jenis Pinjaman">
                            @error('jenis_pinjaman')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Pengembalian</label>
                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{old('nilai')}} "
                            placeholder="Masukkan Nilai Pinjaman">
                            @error('nilai')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Pinjaman</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{old('keterangan')}} "
                            placeholder="Masukkan Keterangan Pinjaman">
                            @error('keterangan')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
