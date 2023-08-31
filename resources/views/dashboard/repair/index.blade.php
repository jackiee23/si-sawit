@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pemeliharaan & Perbaikan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="flash-data" data-flashdata="{{ session('status') }} "></div>
            @endif
            <div class="card-header py-3">
                <a href="/dashboard/repair/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Kendaraan</th>
                                <th>Jenis Kerusakan</th>
                                <th>Jumlah Biaya</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($repair as $repair)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $repair->tgl_perbaikan }} </td>
                                    <td> {{ $repair->car->nama_kendaraan }} </td>
                                    <td> {{ $repair->jenis_kerusakan }} </td>
                                    <td> Rp.{{ number_format($repair->jumlah, 2, ',', '.') }} </td>
                                    <td> {{ $repair->keterangan }} </td>
                                    <td class="text-center">
                                        <a href="/dashboard/repair/{{ $repair->id }}/edit/"><i
                                                class="fas fa-edit text-success"></i></a>
                                        <form id="formHapus" action="/dashboard/repair/{{ $repair->id }} " method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="fas fa-trash text-danger border-0 tombol-hapus"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
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

        const table = $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
            ],
            processing: true,
            // searching: false, info: false,
            order: [
                    [1, 'desc']
                ],
            serverSide: true,
            ajax: '{{ route('repairdata') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                },
                {
                    data: 'tgl_perbaikan',
                    name: 'tgl_perbaikan',
                    // sortable: false
                },
                {
                    data: 'car',
                    name: 'car.nama_kendaraan',
                    sortable: false
                },
                {
                    data: 'jenis_kerusakan',
                    name: 'type.jenis_pemeliharaan',
                    sortable:false
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    sortable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
                //         {
                // 'orderable': false,
                // 'searchable': false,
                // 'data': null,
                // 'render': function (data, type, row, meta) {
                //     console.log(data);
                //     return ' <a id="edit" href="" ><i class="edit fas fa-edit text-success"></i></a> <form id="formHapus" action="/dashboard/farmer/" method="post" class="d-inline" > @method('delete') @csrf <button type="submit" class="fas fa-trash text-danger border-0 tombol-hapus"></button> </form>';
                // }
                // }
            ]
        });

        $('#dataTable tbody').on('click', '.edit', table, function(e) {
            // e.preventDefault();
            const data = table.row($(this).parents('tr')).data();
            $(function() {
                console.log(data.id);
                // document.getElementById("edit").href="/dashboard/car/"+data.id+"/edit/";
                window.open("/dashboard/repair/" + data.id + "/edit/", "_self");
            });
            // const id = console.log(data.id);
            // location.reload()
            //alert('Edit user: ' + data.id);
            //     Swal.fire(
            //   'Good job!',
            //   'You clicked the button!',
            //   'success'
            // )
        });

        $('#dataTable tbody').on('click', '.tombol-delete', table, function(e) {
            const data = table.row($(this).parents('tr')).data();

            e.preventDefault();
            // console.log(data.id)
            const rute = $(this).attr('action');

            Swal.fire({
                title: "Are you sure?",
                text: "You will delete this data & won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $(function() {
                        // document.location.href = href
                        $.ajax({
                            url: "repair/" + data.id,
                            type: "post",
                            dataType: "JSON",
                            data: {
                                repair: data.id,
                                "_method": 'DELETE',
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(data) { //jika sukses
                                Swal.fire(
                                    'Success',
                                    'Data has been deleted!',
                                    'success'
                                )
                                $('#dataTable').DataTable().ajax.reload()
                            },
                            error: function(data) { //jika error
                                Swal.fire(
                                    'Error',
                                    'Data cannot deleted!',
                                    'error'
                                )
                                $('#dataTable').DataTable().ajax.reload()
                            }
                        })
                        // location.reload();
                        // document.getElementById("formHapus").submit();
                    });
                }
            });

        });
    </script>
@endsection
