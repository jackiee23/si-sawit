@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pembelian</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="flash-data" data-flashdata="{{ session('status') }} "></div>
                {{-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> --}}
            @endif
            <div class="card-header py-3 d-flex justify-content-between">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Data admin</h6> --}}
                <a href="/dashboard/purchase/create" class="btn btn-info">Tambah Data</a>
                <div class="col col-sm-3 input-daterange">
                    <input type="text" class="form-control" placeholder="Select Date" readonly />
                </div>
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
                                <th>Nama Pekerja</th>
                                <th>Nama Kendaraan</th>
                                <th>Jumlah Trip</th>
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
            fetch_data();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });



        function fetch_data(start_date = '', end_date = '') {
            const table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('purchasedata') }}",
                    data: {
                        action: 'fetch',
                        start_date: start_date,
                        end_date: end_date
                    },
                },
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
                    window.open("/dashboard/purchase/" + data.id + "/edit/", "_self");
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

        };


        $('.input-daterange input').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('.input-daterange input').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                },
                format: 'YYYY-MM-DD'
            },
            function(start, end) {

                $('#dataTable').DataTable().destroy();

                fetch_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));

            });

        $('.input-daterange input').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
    </script>
@endsection
