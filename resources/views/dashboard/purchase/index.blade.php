@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pembelian</h1>

        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="flash-data" data-flashdata="{{ session('status') }} "></div>
            @endif
            <div class="card-header py-3">
                <a href="/dashboard/purchase/create" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petani</th>
                                <th>Tanggal Panen</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Ketepatan Waktu</th>
                                <th>Jumlah Sawit(Kg)</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Nama Pekerja</th>
                                <th>Nama Kendaraan</th>
                                <th>Jumlah Trip</th>
                                <th>Keterangan</th>
                                {{-- <th>Umur</th> --}}
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Petani</th>
                                <th>Tanggal Panen</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Ketepatan Waktu</th>
                                <th>Jumlah Sawit(Kg)</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Nama Pekerja</th>
                                <th>Nama Kendaraan</th>
                                <th>Jumlah Trip</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot> --}}
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
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
            ],
            processing: true,
            serverSide: true,
            order: [
                [3, 'desc']
            ],
            ajax: '{{ route('purchasedata') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                },
                {
                    data: 'farmer',
                    name: 'farmer.nama',
                    sortable: false
                },
                {
                    data: 'tgl_panen',
                    name: 'tgl_panen'
                },
                {
                    data: 'tgl_beli',
                    name: 'tgl_beli'
                },
                {
                    data: 'selisih',
                    name: 'selisih'
                },
                {
                    data: 'jumlah_sawit',
                    name: 'jumlah_sawit'
                },
                {
                    data: 'harga',
                    name: 'harga'
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
                    data: 'trip',
                    name: 'trip'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    sortable: false
                },
                // {
                //     data: 'umur',
                //     name: 'farmer.umur',
                //     sortable: false
                // },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            // footerCallback: function(row, data, start, end, display) {
            //     var api = this.api();

            //     var columnData = api
            //         .column(6)
            //         .data();

            //     var numFormat = $.fn.dataTable.render.number( '\.', ',',2, 'Rp.' ).display

            //     // Remove the formatting to get integer data for summation
            //     var intVal = function(i) {
            //         return typeof i === 'string' ? i.replace(/[\Rp.,]/g, '') * 1 : typeof i ===
            //             'number' ? i : 0;
            //     };

            //     // Total over this page
            //     pageTotal = api
            //         .column(10, {
            //             page: 'current'
            //         })
            //         .data()
            //         .reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);

            //     sawitTotal = api
            //         .column(5, {
            //             page: 'current'
            //         })
            //         .data()
            //         .reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);

            //     hargaRate = api
            //         .column(6, {
            //             page: 'current'
            //         })
            //         .data()
            //         .reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);

            //     hargaTotal = api
            //         .column(7, {
            //             page: 'current'
            //         })
            //         .data()
            //         .reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);

            //     // Update footer
            //     $(api.column(10).footer()).html(pageTotal);
            //     $(api.column(5).footer()).html(sawitTotal + ' Kg');
            //     $(api.column(6).footer()).html(numFormat(hargaRate/columnData.count()/100));
            //     $(api.column(7).footer()).html(numFormat(hargaTotal/100));

            // },
            // columnDefs: [{
            //         "targets": "_all", // your case first column
            //         "className": "text-center",
            //         "width": "4%"
            //         },
            //     ]
        });

        $('#dataTable tbody').on('click', '.edit', table, function(e) {
            const data = table.row($(this).parents('tr')).data();
            $(function() {
                console.log(data.id);
                window.open("/dashboard/purchase/" + data.id + "/edit/", "_self");
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
                        // document.location.href = href
                        $.ajax({
                            url: "purchase/" + data.id,
                            type: "post",
                            dataType: "JSON",
                            data: {
                                purchase: data.id,
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
