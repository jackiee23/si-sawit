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
                        <label for="nik" class="form-label">Nama</label>
                        <select class="form-control " name="nik" id="nik">
                            {{-- <option value="" selected>Pilih Nama</option> --}}
                            {{-- @foreach ($loans as $loan)
                                <option value="{{ $loan->nik }}" {{ old('nik') == $loan->nik ? 'selected' : '' }}>
                                    {{ $loan->nama }}</option>
                            @endforeach --}}
                        </select>
                        @error('nik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl"
                            name="tgl" value="{{ old('tgl') }}">
                        @error('tgl')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman</label>
                        {{-- <input type="text" class="form-control" name="jenis_pinjaman" id="jenis_pinjaman"> --}}
                        <select class="form-control" name="jenis_pinjaman" id="jenis_pinjaman">
                            <option value="" selected>Pilih Jenis Pinjaman</option>
                            {{-- @foreach ($loans as $loan)
                            <option value=" " {{ old('jenis_pinjaman') }}> </option>
                            @endforeach --}}
                        </select>
                        @error('jenis_pinjaman')
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
                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai"
                            name="nilai" value="{{ old('nilai') }} " placeholder="Masukkan Nilai Pinjaman">
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $("#nik").select2({
            placeholder : 'Pilih Nama',
            ajax:{
                url:"{{ route('getnik') }}",
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return{
                                id: item.nik,
                                text: item.nama
                            }
                        })
                    }
                }
            }
        });

        $("#nik").change(function(){
            let id = $('#nik').val();
            $('#jenis_pinjaman').val(null).trigger('change');

            $("#jenis_pinjaman").select2({
            placeholder : 'Pilih Jenis Pinjaman',
            ajax:{
                url:"{{ url('selectJenis')}}/"+ id,
                processResults: function({data}){
                    return {
                        results: $.map(data, function(item){
                            return{
                                id: item.id,
                                text: item.jenis_pinjaman
                            }
                        })
                    }
                }
            }
        });

        });
        });

    </script>
@endsection
