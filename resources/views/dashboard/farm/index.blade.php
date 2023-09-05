@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Kebun</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="flash-data" data-flashdata="{{ session('status') }} "></div>
            @elseif (session('failed'))
                {
                <div class="failed-data" data-failed="{{ session('failed') }} "></div>
                }
            @endif
            <div class="card-header py-3">
                <a href="/dashboard/farm/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kebun</th>
                                <th>Nama Petani</th>
                                <th>Luas Kebun (Ha)</th>
                                <th>Jarak TPH ke Kebun (m)</th>
                                <th>Umur Tanaman Sawit</th>
                                <th>Jenis Tanah</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>

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
            "pageLength": 20,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
            ],
            processing: true,
            serverSide: true,
            ajax: '{{ route('farmdata') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                },
                {
                    data: 'nama_kebun',
                    name: 'nama_kebun',
                    sortable: false
                },
                {
                    data: 'nama_petani',
                    name: 'nama_petani',
                    sortable: false
                },
                {
                    data: 'luas',
                    name: 'luas'
                },
                {
                    data: 'jarak',
                    name: 'jarak'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'jenis_tanah',
                    name: 'jenis_tanah'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#dataTable tbody').on('click', '.edit', table, function(e) {
            // e.preventDefault();
            const data = table.row($(this).parents('tr')).data();
            $(function() {
                console.log(data.id);
                // document.getElementById("edit").href="/dashboard/car/"+data.id+"/edit/";
                window.open("/dashboard/farm/" + data.id + "/edit/", "_self");
            });
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
                        $.ajax({
                            url: "farm/" + data.id,
                            type: "post",
                            dataType: "JSON",
                            data: {
                                farm: data.id,
                                "_method": 'DELETE',
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(data) { //jika sukses
                                Swal.fire(
                                    'Success',
                                    'Farm data has been deleted!',
                                    'success'
                                )
                                $('#dataTable').DataTable().ajax.reload()
                            },
                            error: function(data) { //jika error
                                Swal.fire(
                                    'Error',
                                    'Farm data cannot deleted!',
                                    'error'
                                )
                                $('#dataTable').DataTable().ajax.reload()
                            }
                        })
                    });
                }
            });

        });
    </script>
@endsection
