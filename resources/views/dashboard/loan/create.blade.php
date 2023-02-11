@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Pinjaman</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/loan">
                    @csrf
                    <div class="mb-3">
                        <label for="bagian" class="form-label">Nama Bagian</label>
                        <select class="form-select form-control" name="bagian" id="bagian">
                        <option value="0" selected>Pilih nama bagian</option>
                        <option value="1" {{ old('bagian') == 1 ? 'selected' : '' }}>Petani</option>
                        <option value="2" {{ old('bagian') == 2 ? 'selected' : '' }}>Pekerja</option>
                        </select>
                            @error('bagian')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3 petani d-none">
                        <label for="inputnama" class="form-label">Nama Petani</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="inputnama" id="inputnama">
                            <option value="" selected>Pilih nama petani</option>
                            @foreach ($farmers as $farmer)
                            <option value="{{$farmer->id}}" {{ old('inputnama') == $farmer->id ? 'selected' : '' }}>{{$farmer->nama}}</option>
                            @endforeach
                        </select>
                        @error('inputnama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 pekerja d-none">
                        <label for="inputpekerja" class="form-label">Nama Pekerja</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="inputpekerja" id="inputpekerja">
                            <option value="" selected>Pilih nama pekerja</option>
                            @foreach ($workers as $worker)
                            <option value="{{$worker->id}}" {{old('inputpekerja') == $worker->id ? 'selected' : ''}} >{{$worker->nama}}</option>
                            @endforeach
                        </select>
                        @error('inputpekerja')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        {{-- <label for="nama" class="form-label">Nama</label> --}}
                        <input type="hidden" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" placeholder="Masukkan Nama Peminjam" value="{{old('nama')}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Pinjaman</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl" value="{{old('tgl')}}">
                            @error('tgl')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pinjaman" class="form-label">Jenis Pinjaman</label>
                        <input type="text" class="form-control @error('jenis_pinjaman') is-invalid @enderror" id="jenis_pinjaman" name="jenis_pinjaman" value="{{old('jenis_pinjaman')}} "
                            placeholder="Masukkan Jenis Pinjaman">
                            @error('jenis_pinjaman')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Pinjaman</label>
                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{old('nilai')}} "
                            placeholder="Masukkan Nilai Pinjaman">
                            @error('nilai')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK Peminjam</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                            name="nik" placeholder="NIK Peminjam" value="{{old('nik')}}" readonly>
                            @error('nik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="nik" class="form-label">NIK Peminjam</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
                            disabled readonly>
                            @error('nik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Pinjaman</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{old('keterangan')}} "
                            placeholder="Masukkan Keterangan Pinjaman">
                            @error('keterangan')
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

    <script>
        $('#bagian').change(function() {
            if ($(this).val() == 1) {
                $('.pekerja').addClass("d-none");
                $('.petani').removeClass("d-none");
                $('#inputpekerja').val('default');
                $('#nik').val(' ');
                $('#nama').val(' ');
                $('#inputpekerja').selectpicker("refresh");
            } else if ($(this).val() == 2) {
                $('.petani').addClass("d-none");
                $('#inputnama').val('default');
                $('#nik').val(' ');
                $('#nama').val(' ');
                $('#inputnama').selectpicker("refresh");
                $('.pekerja').removeClass("d-none");
            } else {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('#inputnama').val('default');
                $('#inputnama').selectpicker("refresh");
                $('#inputpekerja').val('default');
                $('#nik').val('default');
                $('#nama').val('default');
                $('#inputpekerja').selectpicker("refresh");
            }
        });

        $(document).ready(function() {
            if ($('#bagian').val() == 1) {
                $('.pekerja').addClass("d-none");
                $('.petani').removeClass("d-none");
            } else if ($('#bagian').val() == 2) {
                $('.petani').addClass("d-none");
                $('.pekerja').removeClass("d-none");
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    $("#inputnama").change(function(e){
    // alert($(this).val());
    var inputnama = $(this).val();
    var bagian = $('#bagian').val();

    $.ajax({
        type: "POST",
        url: "{{route('getdata')}}",
        data: {'bagian':bagian,
                'id' : inputnama},
        dataType: 'json',
        success : function(data) {
            $('#nik').val(data.nik);
            $('#nama').val(data.nama);
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
});

    $("#inputpekerja").change(function(e){
    // alert($(this).val());
    var inputpekerja = $(this).val();
    var bagian = $('#bagian').val();

    $.ajax({
        type: "POST",
        url: "{{route('getdata')}}",
        data: {'bagian':bagian,
                'id' : inputpekerja},
        dataType: 'json',
        success : function(data) {
            $('#nik').val(data.nik);
            $('#nama').val(data.nama);
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
});
    </script>
@endsection
