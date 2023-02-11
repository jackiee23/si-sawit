@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Pengembalian Pinjaman</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/repayment/{{$repayment->id}} ">
                    @method('patch')
                    @csrf
                    {{-- <div class="mb-3">
                        <label for="nik" class="form-label">Nama</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="nik" id="nik">
                            <option value="{{$repayment->loan_id}}" selected>{{$repayment->loan->nama}}</option> --}}
                            {{-- @foreach ($loans as $loan)
                            <option value="{{$loan->id}}" {{ old('loan_id') == $loan->id ? 'selected' : '' }}>{{$loan->nama}}</option>
                            @endforeach --}}
                        {{-- </select>
                            @error('nik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    {{-- <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl" value="{{old('tgl', $repayment->tgl)}}">
                            @error('tgl')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Pengembalian</label>
                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{old('nilai', $repayment->nilai)}} "
                            placeholder="Masukkan Nilai Pinjaman">
                            @error('nilai')
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
