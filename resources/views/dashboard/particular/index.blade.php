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
                        <option value="1">Laporan Konsumsi BBM</option>
                        <option value="2">Produktivitas Kebun Tanah Gambut</option>
                        <option value="3">Produktivitas Kebun Tanah Keras</option>

                    </select>
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
                                {{-- <canvas id="bar_chart" height="40"> </canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="col-xl-12 col-lg-7 tabel2 d-none">
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
                                <canvas id="myBarChart2"></canvas>
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
                                <th>Nama Kendaraan</th>
                                <th>Total Jarak Tempuh</th>
                                <th>Total Bahan Bakar Mobil Harian</th>
                                <th>Konsumsi Bahan Bakar (m/L)</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total :</th>
                                <th></th>
                                <th></th>
                                <th>Jarak Tempuh</th>
                                <th>Liter</th>
                                <th>m/L</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="table-responsive tabel d-none">
                    <table class="table table-striped table-hover" id="gambutTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                {{-- <th>Nama Pekerja</th> --}}
                                <th>Umur Kebun</th>
                                <th>Ton / Hektar</th>
                                <th>Jumlah Kebun</th>
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
                                <th></th>
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

                <div class="table-responsive tabel2 d-none">
                    <table class="table table-striped table-hover" id="tanahTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                {{-- <th>Nama Pekerja</th> --}}
                                <th>Umur Kebun</th>
                                <th>Ton / Hektar</th>
                                <th>Jumlah Kebun</th>
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
                                <th></th>
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
            tanah_data()
            var myBarChart;
            var myBarChart2;
            var myLineChart;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function kendaraan_data() {
            const table = $('#carTable').DataTable({
                "pageLength": 100,
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
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'car_id',
                        name: 'car_id.nama_kendaraan',
                    },
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

                    var numFormat = $.fn.dataTable.render.number('\.', ',', ).display
                    var numFormat2 = $.fn.dataTable.render.number('\,', ',', ).display

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\Rp.,]/g, '') * 1 : typeof i ===
                            'number' ? i : 0;
                    };


                    var hari = api
                        .column(1)
                        .data()
                        .toArray();

                    var hasil = api
                        .column(5)
                        .data()
                        .toArray();




                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito',
                        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';

                    function number_format(number, decimals, dec_point, thousands_sep) {
                        // *     example: number_format(1234.56, 2, ',', ' ');
                        // *     return: '1 234,56'
                        number = (number + '').replace(',', '').replace(' ', '');
                        var n = !isFinite(+number) ? 0 : +number,
                            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                            s = '',
                            toFixedFix = function(n, prec) {
                                var k = Math.pow(10, prec);
                                return '' + Math.round(n * k) / k;
                            };
                        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || '';
                            s[1] += new Array(prec - s[1].length + 1).join('0');
                        }
                        return s.join(dec);
                    }


                    var ctx = document.getElementById("myAreaChart");
                    // if (myLineChart) {
                    //     myLineChart.clear();
                    // }



                    // Area Chart Example
                    myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: hari,
                            datasets: [{
                                label: "Konsumsi",
                                lineTension: 0.3,
                                backgroundColor: "rgba(78, 115, 223, 0.05)",
                                borderColor: "rgba(78, 115, 223, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointBorderColor: "rgba(78, 115, 223, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: hasil,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'date'
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 27
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return value + ' m/L';
                                        }
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2]
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                intersect: false,
                                mode: 'index',
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex]
                                            .label || '';
                                        return datasetLabel + ' ' + tooltipItem.yLabel.toFixed(2) +
                                            ' m/L';
                                    }
                                }
                            }
                        }
                    });





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
                        .column(4, {
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

                    bbmTotal = api
                        .column(5, {
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

                    var total = konsumsiTotal / jarakTotal;

                    // Update footer
                    // $(api.column(10).footer()).html(pageTotal);
                    // $(api.column(3).footer()).html(petaniTotal + ' Petani');
                    $(api.column(5).footer()).html(numFormat2(total) + ' m/L');
                    $(api.column(4).footer()).html(numFormat(jarakTotal) + ' Liter');
                    $(api.column(3).footer()).html(numFormat(konsumsiTotal) + ' meter');
                    // $(api.column(7).footer()).html(numFormat(hargaRate / columnData.count() / 100));
                    // $(api.column(7).footer()).html(numFormat(hargaTotal / 100));

                },
            });
        };

        function fetch_data() {
            const table = $('#gambutTable').DataTable({
                "pageLength": 35,
                columnDefs: [{
                    "targets": [0, 1, 2], // your case first column
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
                    url: "{{ route('gambutdata') }}",
                    data: {
                        action: 'fetch',
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                    },
                },
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'id',
                    // },
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
                        name: 'ton_hektar',
                        sortable: false

                    },
                    {
                        data: 'total_d',
                        name: 'total_d',
                        sortable: false

                    },
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

                footerCallback: function(row, data, start, end, display, settings) {
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

                    var umur_kebun = api
                        .column(0)
                        .data()
                        .toArray();

                    var ton_hektar = api
                        .column(1)
                        .data()
                        .toArray();




                    var id = document.getElementById("myBarChart");

                    // if (myBarChart) {
                    //     myBarChart.destroy();
                    // }

                    myBarChart = new Chart(id, {
                        type: 'bar',
                        data: {
                            labels: umur_kebun,
                            datasets: [{
                                label: "Produktivitas ",
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: ton_hektar,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'month'
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 35
                                    },
                                    maxBarThickness: 25,
                                }],
                                yAxes: [{
                                    ticks: {
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return value + ' Ton/Hektar';
                                        }
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2]
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex]
                                            .label || '';
                                        return datasetLabel + ":" + tooltipItem.yLabel.toFixed(2) +
                                            " Ton/Hektar";
                                    }
                                }
                            },
                        }
                    });




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

        function tanah_data() {
            const table = $('#tanahTable').DataTable({
                "pageLength": 35,
                columnDefs: [{
                    "targets": [0, 1, 2], // your case first column
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
                    url: "{{ route('tanahdata') }}",
                    data: {
                        action: 'fetch',
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                    },
                },
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'id',
                    // },
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
                        name: 'ton_hektar',
                        sortable: false

                    },
                    {
                        data: 'total_data',
                        name: 'total_data',
                        sortable: false

                    },
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

                    var umur2 = api
                        .column(0)
                        .data()
                        .toArray();

                    var ton_hektar2 = api
                        .column(1)
                        .data()
                        .toArray();

                    var numFormat = $.fn.dataTable.render.number('\.', ',', 2, 'Rp.').display

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\Rp.,]/g, '') * 1 : typeof i ===
                            'number' ? i : 0;
                    };



                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito',
                        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';

                    function number_format(number, decimals, dec_point, thousands_sep) {
                        // *     example: number_format(1234.56, 2, ',', ' ');
                        // *     return: '1 234,56'
                        number = (number + '').replace(',', '').replace(' ', '');
                        var n = !isFinite(+number) ? 0 : +number,
                            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                            s = '',
                            toFixedFix = function(n, prec) {
                                var k = Math.pow(10, prec);
                                return '' + Math.round(n * k) / k;
                            };
                        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || '';
                            s[1] += new Array(prec - s[1].length + 1).join('0');
                        }
                        return s.join(dec);
                    }

                    // Bar Chart Example
                    var asu = document.getElementById("myBarChart2");
                    myBarChart2 = new Chart(asu, {
                        type: 'bar',
                        data: {
                            labels: umur2,
                            datasets: [{
                                label: "Produktivitas ",
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: ton_hektar2,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'month'
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 35
                                    },
                                    maxBarThickness: 25,
                                }],
                                yAxes: [{
                                    ticks: {
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return value + ' Ton/Hektar';
                                        }
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2]
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex]
                                            .label || '';
                                        return datasetLabel + ":" + tooltipItem.yLabel.toFixed(2) +
                                            " Ton/Hektar";
                                    }
                                }
                            },
                        }
                    });



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
                $('#gambutTable').DataTable().destroy();
                fetch_data();
            } else if ($('#tipe_laporan').val() == 3) {
                $('#tanahTable').DataTable().destroy();
                tanah_data();
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
                $('#gambutTable').DataTable().destroy();
                $('#tanahTable').DataTable().destroy();
                myLineChart.destroy();
                myBarChart.destroy();
                myBarChart2.destroy();
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));

                kendaraan_data();
                fetch_data();
                tanah_data();
            });

        $('#car_id').change(function() {
            $('#carTable').DataTable().destroy();
            kendaraan_data();
            myLineChart.destroy();
        });

        $('#tipe_laporan').change(function() {
            if ($(this).val() == 1) {
                $('.tabel').addClass("d-none");
                $('.tabel2').addClass("d-none");
                $('.kendaraan').removeClass("d-none");
            } else if ($(this).val() == 2) {
                $('.kendaraan').addClass("d-none");
                $('.tabel2').addClass("d-none");
                $('.tabel').removeClass("d-none");
            } else if ($(this).val() == 3) {
                $('.kendaraan').addClass("d-none");
                $('.tabel').addClass("d-none");
                $('.tabel2').removeClass("d-none");
            } else {
                $('.kendaraan').addClass("d-none");
                $('.tabel').addClass("d-none");
                $('.tabel2').addClass("d-none");
            }
        });

        // const penghasilan = {{ json_encode($meter) }}
        // const nama_b = {!! $nama_b !!}
        // const ton_hektar = {{ json_encode($ton_hektar) }}
        // const umur = {!! $umur !!}
        // const ton_hektar2 = {{ json_encode($ton) }}
        // const umur2 = {!! $umur2 !!}
    </script>
    {{-- <script src="{{ asset('template/js/demo/chart-area-2.js') }}"></script> --}}
    {{-- <script src="{{asset('template/js/demo/chart-bar.js')}}"></script> --}}
    {{-- <script src="{{ asset('template/js/demo/chart-bar-2.js') }}"></script> --}}
    {{-- <script src="{{ asset('template/js/demo/Chart.bundle.min.js') }}"></script> --}}
@endsection
