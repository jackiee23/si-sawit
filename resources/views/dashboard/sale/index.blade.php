@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Penjualan</h1>

        <div class="card shadow mb-4">
            @if (session('status'))
            <div class="flash-data" data-flashdata="{{session('status')}} "></div>
            @endif
            <div class="card-header py-3">
                <a href="/dashboard/sale/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Jual</th>
                                <th>Jumlah Sawit Dibawa(Kg)</th>
                                <th>Sortasi (%)</th>
                                <th>Potongan Sortasi (Kg)</th>
                                <th>Jumlah Sawit Netto(Kg)</th>
                                <th>Harga Pabrik</th>
                                <th>Omset Penjualan</th>
                                <th>Nama Pekerja</th>
                                <th>Nama Kendaraan</th>
                                <th>Nama Pabrik</th>
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
            "pageLength": 20,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
            ],
            processing: true,
            serverSide: true,
            order: [
                    [1, 'desc']
                ],
            ajax: "{{ route('saledata') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                },
                {
                    data: 'tgl_jual',
                    name: 'tgl_jual',
                    // sortable: false
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'sortasi',
                    name: 'sortasi'
                },
                {
                    data: 'potongan',
                    name: 'potongan'
                },
                {
                    data: 'jumlah_net',
                    name: 'jumlah_net'
                },
                {
                    data: 'harga_pabrik',
                    name: 'harga_pabrik'
                },
                {
                    data: 'harga_total',
                    name: 'harga_total'
                },
                {
                    data: 'worker',
                    name: 'worker.nama',
                    sortable: false
                },
                {
                    data: 'car',
                    name: 'car.nama_kendaraan',
                    sortable: false
                },
                {
                    data: 'pabrik',
                    name: 'pabrik',
                    sortable: false
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
            ]
        });

        $('#dataTable tbody').on('click', '.edit', table, function(e) {
            const data = table.row($(this).parents('tr')).data();
            $(function() {
                console.log(data.id);
                window.open("/dashboard/sale/" + data.id + "/edit/", "_self");
            });
        });

        $('#dataTable tbody').on('click', '.tombol-delete', table, function(e) {
            const data = table.row($(this).parents('tr')).data();

            e.preventDefault();
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
                            url: "sale/" + data.id,
                            type: "post",
                            dataType: "JSON",
                            data: {
                                sale: data.id,
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
                            error : function(data) { //jika error
                                Swal.fire(
                                    'Error',
                                    'Data cannot deleted!',
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
