@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Kebun</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="/dashboard/farm/{{$farm->id}}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="inputnama" class="form-label">Nama Kebun</label>
                        <input type="text" class="form-control @error('nama_kebun') is-invalid @enderror" id="inputnama"
                            name="nama_kebun" placeholder="Masukkan Nama Petani" value="{{old('nama_kebun', $farm->nama_kebun)}} ">
                            @error('nama_kebun')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="farmer_id" class="form-label">Nama Petani</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="farmer_id" id="farmer_id">
                            <option value="{{$farm->farmer_id}} " selected>{{$farm->farmer->nama}}</option>
                            @foreach ($farmer as $farmer)
                            <option value="{{$farmer->id}}" {{old('farmer_id') == $farmer->id ? 'selected' : ''}} >{{$farmer->nama}}</option>
                            @endforeach
                        </select>
                        @error('farmer_id')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK Petani</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                            name="nik" placeholder="NIK Petani" value="{{old('nik')}}" readonly>
                            @error('nik')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3" name="alamat">{{old('alamat', $farm->alamat)}}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    {{-- <div class="mb-3">
                        <label for="no_wa" class="form-label">No WA</label>
                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{old('no_wa', $farm->no_wa)}} "
                            placeholder="Masukkan Nomer WA">
                            @error('no_wa')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="luas" class="form-label">Luas Kebun (Ha)</label>
                        <input type="text" class="form-control @error('luas') is-invalid @enderror" id="luas" name="luas" value="{{old('luas', $farm->luas)}} "
                            placeholder="Masukkan Luas Kebun">
                            @error('luas')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jarak" class="form-label">Jarak TPH ke Kebun (m)</label>
                        <input type="text" class="form-control @error('jarak') is-invalid @enderror" id="jarak" name="jarak" value="{{old('jarak', $farm->jarak)}} "
                            placeholder="Masukkan Jarak">
                            @error('jarak')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="umur" class="form-label">Tahun Tanam</label>
                        <input type="date" class="form-control @error('umur') is-invalid @enderror" id="umur"
                            name="umur" value="{{ old('umur', $farm->umur) }}">
                        @error('umur')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="umur" class="form-label">Umur Tanaman Sawit</label>
                        <input type="text" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{old('umur', $farm->umur)}} "
                            placeholder="Masukkan Umur Kebun">
                            @error('umur')
                            <div class="invalid-feedback">
                                Tidak boleh di kosongkan.
                            </div>
                            @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="jenis_tanah" class="form-label">Jenis Tanah</label>
                        <select class="form-select form-control selectpicker" data-live-search="true" name="jenis_tanah" id="jenis_tanah">
                            <option value="{{$farm->jenis_tanah}}" selected>{{$farm->jenis_tanah}}</option>
                            <option value="Tanah Keras" {{old('jenis_tanah') ? 'selected' : ''}} >Tanah Keras</option>
                            <option value="Gambut" {{old('jenis_tanah') ? 'selected' : ''}} >Gambut</option>
                        </select>
                        @error('jenis_tanah')
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

        <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


            $("#farmer_id").change(function(e){
    // alert($(this).val());
    var farmer_id = $(this).val();

    $.ajax({
        type: "POST",
        url: "{{route('getfarmer')}}",
        data: {'id' : farmer_id},
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
