@extends('dashboard.layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Laporan</h1>

        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="flash-data" data-flashdata="{{ session('status') }} "></div>
            @endif
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="mb-3 col-3">
                    <label for="tipe_laporan" class="form-label">Pilih Tipe Laporan</label>
                    <select class="form-select form-control" name="tipe_laporan" id="tipe_laporan">
                        <option value="0" selected>Pilih tipe laporan</option>
                        <option value="1">Laporan Petani</option>
                        <option value="2">Laporan Pekerja</option>
                        <option value="3">Laporan Bahan Bakar</option>
                        <option value="4">Laporan Pemasukan</option>
                        <option value="5">Laporan Kendaraan</option>
                        <option value="6">Laporan Laba Rugi</option>
                        <option value="7">Selisih Jumlah Sawit</option>
                        <option value="8">Laporan Pengeluaran</option>

                    </select>
                </div>
                <div class="mb-3 col-3 petani d-none">
                    <label for="farmer_id" class="form-label">Nama Petani</label>
                    <select class="form-select form-control selectpicker" data-live-search="true" name="farmer_id"
                        id="farmer_id">
                        <option value="" selected>Pilih nama petani</option>
                        @foreach ($farmer as $farmer)
                            <option value="{{ $farmer->id }}" {{ old('farmer_id') == $farmer->id ? 'selected' : '' }}>
                                {{ $farmer->nama }}</option>
                        @endforeach
                    </select>
                    <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                </div>
                <div class="mb-3 col-3 pekerja d-none">
                    <label for="worker_id" class="form-label">Nama Pekerja</label>
                    <select class="form-select form-control selectpicker" data-live-search="true" name="worker_id"
                        id="worker_id">
                        <option value="" selected>Pilih nama pekerja</option>
                        @foreach ($worker as $worker)
                            <option value="{{ $worker->id }}">{{ $worker->nama }}</option>
                        @endforeach
                    </select>
                    <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
                </div>
                <div class="mb-3 col-3 kendaraan d-none">
                    <label for="car_id" class="form-label">Nama Kendaraan</label>
                    <select class="form-select form-control selectpicker" data-live-search="true" name="car_id"
                        id="car_id">
                        <option value="" selected>Pilih nama kendaraan</option>
                        @foreach ($car as $car)
                            <option value="{{ $car->id }}">{{ $car->nama_kendaraan }}</option>
                        @endforeach
                    </select>
                </div>
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
                <div class="table-responsive tabel d-none">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pekerja</th>
                                <th>Nama Petani</th>
                                <th>Tanggal Panen</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Ketepatan Waktu</th>
                                <th>Jumlah Sawit(Kg)</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Nama Kendaraan</th>
                                <th>Jumlah Trip</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total :</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Jumlah Sawit(Kg)</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th></th>
                                <th>Jumlah Trip</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive bahan-bakar d-none">
                    <table class="table table-striped table-hover" id="fuelTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengisian</th>
                                <th>Kendaraan</th>
                                <th>Jumlah Bahan Bakar Harian</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive pemasukan d-none">
                    <table class="table table-striped table-hover" id="pemasukanTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Sawit(Kg)</th>
                                <th>Harga Pabrik</th>
                                <th>Omset Penjualan</th>
                                {{-- <th>Nama Pabrik</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive kendaraan d-none">
                    <table class="table table-striped table-hover" id="carTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Kendaraan</th>
                                <th>Jumlah Petani</th>
                                <th>Jarak Tempuh</th>
                                <th>Bahan Bakar Mobil Harian</th>
                                <th>Konsumsi Bahan Bakar (M/liter)</th>
                                <th>Harga Perbaikan Harian</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive sawit d-none">
                    <table class="table table-striped table-hover" id="sawitTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Sawit(Kg) Harian, Pembelian</th>
                                <th>Jumlah Sawit(Kg) Harian, Penjualan</th>
                                <th>Selisih Keduanya</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive spend d-none">
                    <table class="table table-striped table-hover" id="spendTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Sawit(Kg) Harian, Pembelian</th>
                                <th>Total Pembelian Harian (Rp)</th>
                                <th>Harga Perbaikan Harian</th>
                                <th>Harga Bahan Bakar Harian</th>
                                <th>Total Pengeluaran Harian</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive profit d-none">
                    <table class="table table-striped table-hover" id="profitTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Sawit(Kg) Harian, Pembelian</th>
                                <th>Total Pembelian Harian (Rp)</th>
                                <th>Harga Perbaikan Harian</th>
                                <th>Harga Bahan Bakar Harian</th>
                                <th>Total Pengeluaran Harian</th>
                                <th>Total Pemasukan Harian</th>
                                <th>Total Profit</th>
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
            reload_data();
            pemasukan_data();
            kendaraan_data();
            sawit_data();
            spend_data();
            profit_data();


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
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                searching: false,
                processing: true,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    url: "{{ route('carday') }}",
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
                    {
                        data: 'nama_kendaraan',
                        name: 'nama_kendaraan',
                    },
                    {
                        data: 'jumlah_petani',
                        name: 'jumlah_petani',
                    },
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
                    {
                        data: 'perbaikan',
                        name: 'perbaikan',
                    },
                ],
            });
        };

        function sawit_data() {
            const table = $('#sawitTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                searching: false,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    url: "{{ route('sawitday') }}",
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
                    {
                        data: 'tgl_beli',
                        name: 'tgl_beli',
                    },
                    {
                        data: 'pembelian_sawit',
                        name: 'pembelian_sawit'
                    },
                    {
                        data: 'penjualan_sawit',
                        name: 'penjualan_sawit'
                    },
                    {
                        data: 'selisih',
                        name: 'selisih'
                    },
                ]
            });
        };

        function spend_data() {
            const table = $('#spendTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                searching: false,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    url: "{{ route('spend') }}",
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
                    {
                        data: 'tgl',
                        name: 'tgl',
                    },
                    {
                        data: 'pembelian_sawit',
                        name: 'pembelian_sawit'
                    },
                    {
                        data: 'harga_pembelian',
                        name: 'harga_pembelian'
                    },
                    {
                        data: 'bahan_bakar',
                        name: 'bahan_bakar'
                    },
                    {
                        data: 'perbaikan',
                        name: 'perbaikan'
                    },
                    {
                        data: 'total_pengeluaran',
                        name: 'total_pengeluaran'
                    },
                ],
                columnDefs: [{
                    "targets": "_all", // your case first column
                    "className": "text-center",
                    "width": "4%"
                }, ]
            });
        };

        function profit_data() {
            const table = $('#profitTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                searching: false,
                columnDefs: [{
                        "targets": "_all", // your case first column
                        "className": "text-center",
                        "width": "4%"
                    },
                    {
                        "targets": [2, 3, 4, 5],
                        "visible": false
                    }
                ],
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    url: "{{ route('profit') }}",
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
                    {
                        data: 'tgl',
                        name: 'tgl',
                    },
                    {
                        data: 'pembelian_sawit',
                        name: 'pembelian_sawit'
                    },
                    {
                        data: 'harga_pembelian',
                        name: 'harga_pembelian'
                    },
                    {
                        data: 'bahan_bakar',
                        name: 'bahan_bakar'
                    },
                    {
                        data: 'perbaikan',
                        name: 'perbaikan'
                    },
                    {
                        data: 'total_pengeluaran',
                        name: 'total_pengeluaran'
                    },
                    {
                        data: 'omset',
                        name: 'omset'
                    },
                    {
                        data: 'profit',
                        name: 'profit'
                    },
                ],

            });
        };

        function pemasukan_data() {
            const table = $('#pemasukanTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                searching: false,
                order: [
                    [1, 'desc']
                ],
                serverSide: true,
                ajax: {
                    url: "{{ route('saledata') }}",
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
                    {
                        data: 'tgl_jual',
                        name: 'tgl_jual',
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'harga_pabrik',
                        name: 'harga_pabrik'
                    },
                    {
                        data: 'harga_total',
                        name: 'harga_total'
                    },
                ]
            });
        };

        function reload_data() {
            const table = $('#fuelTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                searching: false,
                order: [
                    [1, 'desc']
                ],
                serverSide: true,
                ajax: {
                    url: "{{ route('fuelday') }}",
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
                    {
                        data: 'my_date',
                        name: 'my_date',
                    },
                    {
                        data: 'car',
                        name: 'car.nama_kendaraan',
                        sortable: false
                    },
                    {
                        data: 'total_liter',
                        name: 'total_liter'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'total_harga',
                        name: 'total_harga'
                    },
                ]
            });
        };

        function fetch_data() {
            const table = $('#dataTable').DataTable({
                columnDefs: [{
                    "targets": [10, 9, 8, 7, 6, 5], // your case first column
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
                    [3, 'desc']
                ],
                serverSide: true,
                ajax: {
                    url: "{{ route('purchasedata') }}",
                    data: {
                        action: 'fetch',
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                        farmer_id: $('#farmer_id').val(),
                        worker_id: $('#worker_id').val()
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                    },
                    {
                        data: 'worker',
                        name: 'worker.nama',
                        sortable: false
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
                        data: 'car',
                        name: 'car.nama_kendaraan',
                        sortable: false
                    },
                    {
                        data: 'trip',
                        name: 'trip'
                    },
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    var columnData = api
                        .column(6)
                        .data();

                    var numFormat = $.fn.dataTable.render.number('\.', ',', 2, 'Rp.').display

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\Rp.,]/g, '') * 1 : typeof i ===
                            'number' ? i : 0;
                    };

                    // Total over this page
                    pageTotal = api
                        .column(10, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    sawitTotal = api
                        .column(6, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    hargaRate = api
                        .column(7, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    hargaTotal = api
                        .column(8, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(10).footer()).html(pageTotal);
                    $(api.column(6).footer()).html(sawitTotal + ' Kg');
                    $(api.column(7).footer()).html(numFormat(hargaRate / columnData.count() / 100));
                    $(api.column(8).footer()).html(numFormat(hargaTotal / 100));

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
                $('#dataTable').DataTable().destroy();
                fetch_data();
                var dt = $('#dataTable').DataTable();
                dt.columns([1, 4, 5, 9]).visible(false);
            } else if ($('#tipe_laporan').val() == 2) {
                $('#dataTable').DataTable().destroy();
                fetch_data();
                var dt = $('#dataTable').DataTable();
                dt.columns([3, 5, 6, 7, 8]).visible(false);
            } else if ($('#tipe_laporan').val() == 3) {
                $('#fuelTable').DataTable().destroy();
                reload_data();
            } else if ($('#tipe_laporan').val() == 4) {
                $('#pemasukanTable').DataTable().destroy();
                pemasukan_data();
            } else if ($('#tipe_laporan').val() == 5) {
                $('#carTable').DataTable().destroy();
                kendaraan_data();
            } else if ($('#tipe_laporan').val() == 7) {
                $('#sawitTable').DataTable().destroy();
                sawit_data();
            } else if ($('#tipe_laporan').val() == 8) {
                $('#spendTable').DataTable().destroy();
                spend_data();
            } else if ($('#tipe_laporan').val() == 6) {
                $('#profitTable').DataTable().destroy();
                profit_data();
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

                $('#dataTable').DataTable().destroy();
                $('#fuelTable').DataTable().destroy();
                $('#carTable').DataTable().destroy();
                $('#profitTable').DataTable().destroy();
                $('#pemasukanTable').DataTable().destroy();
                $('#sawitTable').DataTable().destroy();
                $('#spendTable').DataTable().destroy();
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));

                var farmer = $('#farmer_id').val();
                var worker = $('#worker_id').val();
                if ($('#tipe_laporan').val() == 2) {
                    fetch_data();
                    var dt = $('#dataTable').DataTable();
                    dt.columns([3, 5, 6, 7, 8]).visible(false);
                } else if ($('#tipe_laporan').val() == 1) {
                    fetch_data();
                    var dt = $('#dataTable').DataTable();
                    dt.columns([1, 4, 5, 9]).visible(false);
                } else if ($('#tipe_laporan').val() == 3) {
                    reload_data();
                } else if ($('#tipe_laporan').val() == 4) {
                    pemasukan_data();
                } else if ($('#tipe_laporan').val() == 5) {
                    kendaraan_data();
                } else if ($('#tipe_laporan').val() == 7) {
                    sawit_data();
                } else if ($('#tipe_laporan').val() == 6) {
                    profit_data();
                } else if ($('#tipe_laporan').val() == 8) {
                    spend_data();
                };
            });

        $('#farmer_id').change(function() {

            $('#dataTable').DataTable().destroy();
            fetch_data();
            var dt = $('#dataTable').DataTable();
            dt.columns([1, 4, 5, 9]).visible(false);
        });

        $('#car_id').change(function() {

            $('#carTable').DataTable().destroy();
            kendaraan_data();
        });


        $('#worker_id').change(function() {
            $('#dataTable').DataTable().destroy();
            fetch_data();
            var dt = $('#dataTable').DataTable();
            dt.columns([3, 5, 6, 7, 8]).visible(false);
        });

        $('#tipe_laporan').change(function() {
            if ($(this).val() == 1) {
                $('.pekerja').addClass("d-none");
                $('.profit').addClass("d-none");
                var dt = $('#dataTable').DataTable();
                dt.columns().visible(true);
                $('.petani').removeClass("d-none");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('#car_id').val('default');
                $('#car_id').selectpicker("refresh");
                $('.pemasukan').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.tabel').removeClass("d-none");
                dt.columns([1, 4, 5, 9]).visible(false);
            } else if ($(this).val() == 2) {
                $('.petani').addClass("d-none");
                $('.profit').addClass("d-none");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#car_id').val('default');
                $('#car_id').selectpicker("refresh");
                var dt = $('#dataTable').DataTable();
                dt.columns().visible(true);
                dt.columns([3, 5, 6, 7, 8]).visible(false);
                $('.pekerja').removeClass("d-none");
                $('.tabel').removeClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.sawit').addClass("d-none");
            } else if ($(this).val() == 3) {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.profit').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('#car_id').val('default');
                $('#car_id').selectpicker("refresh");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('.tabel').addClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('.bahan-bakar').removeClass("d-none");
            } else if ($(this).val() == 4) {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.profit').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('#car_id').val('default');
                $('#car_id').selectpicker("refresh");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('.tabel').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.pemasukan').removeClass("d-none");
            } else if ($(this).val() == 5) {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.profit').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('.tabel').addClass("d-none");
                $('.kendaraan').removeClass("d-none");
            } else if ($(this).val() == 7) {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.profit').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('.spend').addClass("d-none");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('.tabel').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('.sawit').removeClass("d-none");
            } else if ($(this).val() == 8) {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('.tabel').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('.profit').addClass("d-none");
                $('.spend').removeClass("d-none");
            } else if ($(this).val() == 6) {
                $('.petani').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.bahan-bakar').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('#farmer_id').val('default');
                $('#farmer_id').selectpicker("refresh");
                $('#worker_id').val('default');
                $('#worker_id').selectpicker("refresh");
                $('.tabel').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.profit').removeClass("d-none");
            } else {
                $('.bahan-bakar').addClass("d-none");
                $('.sawit').addClass("d-none");
                $('.spend').addClass("d-none");
                $('.pekerja').addClass("d-none");
                $('.petani').addClass("d-none");
                $('.tabel').addClass("d-none");
                $('.pemasukan').addClass("d-none");
                $('.kendaraan').addClass("d-none");
                $('.profit').addClass("d-none");
            }
        });
    </script>
@endsection
