@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Laporan Khusus</h1>

        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="flash-data" data-flashdata="{{ session('status') }} "></div>
            @endif
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="mb-3 col-3">
                    <label for="tipe_laporan" class="form-label">Pilih Tipe Laporan</label>
                    <select class="form-select form-control" name="tipe_laporan" id="tipe_laporan">
                        <option value="0" selected>Pilih tipe laporan</option>
                        <option value="1">Laporan Bahan Bakar</option>
                        <option value="2">Produktivitas Kebun</option>

                    </select>
                </div>
                {{-- <div class="mb-3 col-3 kendaraan d-none">
                    <label for="car_id" class="form-label">Nama Kendaraan</label>
                    <select class="form-select form-control selectpicker" data-live-search="true" name="car_id"
                        id="car_id">
                        <option value="" selected>Pilih nama kendaraan</option>
                        @foreach ($car as $car)
                            <option value="{{ $car->id }}">{{ $car->nama_kendaraan }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col col-3">
                    <label for="worker_id" class="form-label">Filter Tanggal</label>
                    <div class="col d-flex">
                        <input type="text" class="form-control input-daterange" placeholder="Select Date" readonly />
                        <div class="col">
                            <input type="hidden" value="" name="start_date" id="start_date">
                            <input type="hidden" value="" name="end_date" id="end_date">
                            <button class="btn btn-primary reset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-7 kendaraan d-none">
                    <div class="card shadow mb-4">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Konsumsi Bahan Bakar</h6>
                            {{-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> --}}
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="col-xl-12 col-lg-7 tabel d-none">
                    <div class="card shadow mb-4">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Produktivitas Kebun</h6>
                            {{-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> --}}
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive kendaraan d-none">
                    <table class="table table-striped table-hover" id="carTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jarak Tempuh</th>
                                <th>Bahan Bakar Mobil Harian</th>
                                <th>Konsumsi Bahan Bakar (M/liter)</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total :</th>
                                <th></th>
                                <th>Jarak Tempuh</th>
                                <th>Liter</th>
                                <th>M/L</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="table-responsive tabel d-none">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                {{-- <th>Nama Pekerja</th> --}}
                                <th>Umur Kebun</th>
                                <th>Ton / Hektar</th>
                                {{-- <th>Tanggal Pengambilan</th> --}}
                                {{-- <th>Ketepatan Waktu</th> --}}
                                {{-- <th>Jumlah Sawit(Kg)</th> --}}
                                {{-- <th>umur</th> --}}
                                {{-- <th>Total Harga</th> --}}
                                {{-- <th>Nama Kendaraan</th> --}}
                                {{-- <th>Jumlah Trip</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                {{-- <th>Total :</th> --}}
                                {{-- <th></th> --}}
                                <th></th>
                                <th></th>
                                {{-- <th></th> --}}
                                {{-- <th></th> --}}
                                {{-- <th>Jumlah Sawit(Kg)</th> --}}
                                {{-- <th>Harga</th> --}}
                                {{-- <th>Total Harga</th> --}}
                                {{-- <th></th> --}}
                                {{-- <th>Jumlah Trip</th> --}}
                            </tr>
                        </tfoot>
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
            kendaraan_data();
            fetch_data()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function kendaraan_data() {
            const table = $('#carTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf',
                ],
                searching: false,
                processing: true,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    url: "{{ route('petrolday') }}",
                    data: {
                        action: 'fetch',
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                        car_id: $('#car_id').val(),
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                    },
                    {
                        data: 'tgl_beli',
                        name: 'tgl_beli'
                    },
                    // {
                    //     data: 'nama_kendaraan',
                    //     name: 'nama_kendaraan',
                    // },
                    // {
                    //     data: 'jumlah_petani',
                    //     name: 'jumlah_petani',
                    // },
                    {
                        data: 'jarak_total',
                        name: 'jarak_total',
                    },
                    {
                        data: 'jumlah_liter',
                        name: 'jumlah_liter'
                    },
                    {
                        data: 'konsumsi',
                        name: 'konsumsi',
                    },
                    // {
                    //     data: 'perbaikan',
                    //     name: 'perbaikan',
                    // },
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    // var columnData = api
                    //     .column(5)
                    //     .data();

                    var numFormat = $.fn.dataTable.render.number('\.', ',', 2, 'Rp.').display

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\Rp.,]/g, '') * 1 : typeof i ===
                            'number' ? i : 0;
                    };

                    // Total over this page
                    // pageTotal = api
                    //     .column(3, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // petaniTotal = api
                    //     .column(3, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    jarakTotal = api
                        .column(2, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    konsumsiTotal = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // hargaRate = api
                    //     .column(4, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // hargaTotal = api
                    //     .column(7, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // Update footer
                    // $(api.column(10).footer()).html(pageTotal);
                    // $(api.column(3).footer()).html(petaniTotal + ' Petani');
                    $(api.column(2).footer()).html(jarakTotal + ' ');
                    $(api.column(3).footer()).html(konsumsiTotal + ' Liter');
                    // $(api.column(7).footer()).html(numFormat(hargaRate / columnData.count() / 100));
                    // $(api.column(7).footer()).html(numFormat(hargaTotal / 100));

                },
            });
        };

        function fetch_data() {
            const table = $('#dataTable').DataTable({
                columnDefs: [{
                    "targets": [0, 1,2], // your case first column
                    "className": "text-center",
                    "width": "4%"
                }, ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
                searching: false,
                processing: true,
                order: [
                    [1, 'desc']
                ],
                serverSide: true,
                ajax: {
                    url: "{{ route('farmdata') }}",
                    data: {
                        action: 'fetch',
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                    },
                    // {
                    //     data: 'worker',
                    //     name: 'worker.nama',
                    //     sortable: false
                    // },
                    {
                        data: 'umur',
                        name: 'umur',
                        sortable: false
                    },
                    {
                        data: 'ton_hektar',
                        name: 'ton_hektar'
                    },
                    // {
                    //     data: 'tgl_beli',
                    //     name: 'tgl_beli'
                    // },
                    // {
                    //     data: 'selisih',
                    //     name: 'selisih'
                    // },
                    // {
                    //     data: 'jumlah_sawit',
                    //     name: 'jumlah_sawit'
                    // },
                    // {
                    //     data: 'umur',
                    //     name: 'farmer.umur'
                    // },
                    // {
                    //     data: 'harga_total',
                    //     name: 'harga_total'
                    // },
                    // {
                    //     data: 'car',
                    //     name: 'car.nama_kendaraan',
                    //     sortable: false
                    // },
                    // {
                    //     data: 'trip',
                    //     name: 'trip'
                    // },
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    var columnData = api
                        .column(1)
                        .data();

                    var numFormat = $.fn.dataTable.render.number('\.', ',', 2, 'Rp.').display

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\Rp.,]/g, '') * 1 : typeof i ===
                            'number' ? i : 0;
                    };

                    // Total over this page
                    // pageTotal = api
                    //     .column(10, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // sawitTotal = api
                    //     .column(3, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // hargaRate = api
                    //     .column(7, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // hargaTotal = api
                    //     .column(8, {
                    //         page: 'current'
                    //     })
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);

                    // Update footer
                    // $(api.column(10).footer()).html(pageTotal);
                    // $(api.column(3).footer()).html(sawitTotal + ' Kg');
                    // $(api.column(7).footer()).html(numFormat(hargaRate / columnData.count() / 100));
                    // $(api.column(8).footer()).html(numFormat(hargaTotal / 100));

                },
            });
        };

        $('.input-daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('.reset').on('click', function() {
            $('.input-daterange').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            if ($('#tipe_laporan').val() == 1) {
                $('#carTable').DataTable().destroy();
                kendaraan_data();
            } else if ($('#tipe_laporan').val() == 2) {
                $('#dataTable').DataTable().destroy();
                fetch_data();
            }
        });

        $('.input-daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('.input-daterange').daterangepicker({
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

                $('#carTable').DataTable().destroy();
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));

                if ($('#tipe_laporan').val() == 1) {
                    kendaraan_data();
                } else if ($('#tipe_laporan').val() == 2) {
                    fetch_data();
                }
            });

        $('#car_id').change(function() {
            $('#carTable').DataTable().destroy();
            kendaraan_data();
        });

        $('#tipe_laporan').change(function() {
            if ($(this).val() == 1) {
                $('.tabel').addClass("d-none");
                $('.kendaraan').removeClass("d-none");
            } else if ($(this).val() == 2) {
                $('.kendaraan').addClass("d-none");
                $('.tabel').removeClass("d-none");
            }else {
                $('.kendaraan').addClass("d-none");
                $('.tabel').addClass("d-none");
            }
        });

            const penghasilan = {{json_encode($meter)}}
            const nama_bulan = {!! $nama_b !!}
            const ton_hektar = {{json_encode($ton_hektar)}}
            const umur = {!! $umur !!}
    </script>
    <script src="{{asset('template/js/demo/chart-area-2.js')}}"></script>
    <script src="{{asset('template/js/demo/chart-bar.js')}}"></script>
@endsection
