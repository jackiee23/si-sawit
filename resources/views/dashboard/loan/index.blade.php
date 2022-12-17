@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pinjaman</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
            <div class="flash-data" data-flashdata="{{session('status')}} "></div>
                {{-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> --}}
            @endif
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Data admin</h6> --}}
                <a href="/dashboard/loan/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Pinjaman</th>
                                <th>Jenis Pinjaman</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
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
            processing: true,
            serverSide: true,
            order: [
                    [2, 'desc']
                ],
            ajax: '{{ route('loandata') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                },
                {
                    data: 'nama',
                    name: 'nama',
                    sortable: false
                },
                {
                    data: 'tgl',
                    name: 'tgl'
                },
                {
                    data: 'jenis_pinjaman',
                    name: 'jenis_pinjaman',
                    sortable: false
                },
                {
                    data: 'nilai',
                    name: 'nilai'
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
                window.open("/dashboard/loan/" + data.id + "/edit/", "_self");
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
                            url: "loan/" + data.id,
                            type: "post",
                            dataType: "JSON",
                            data: {
                                loan: data.id,
                                "_method": 'DELETE',
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(data) { //jika sukses
                                Swal.fire(
                                    'Success',
                                    'Loan data has been deleted!',
                                    'success'
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
