<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    {{-- <meta name="description" content=""> --}}
    {{-- <meta name="author" content=""> --}}

    <title>Sistem Rekapitulasi Panen Sawit - {{$title}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('bselect/css/bootstrap-select.css')}}">
    <link href="{{asset('daterange/daterangepicker.css')}}" rel="stylesheet" />


        <!-- Page level plugins -->
    <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Page level plugins -->
    <script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/demo/data.js')}}"></script> --}}

        <!-- daterange filter plugins -->
    <script src="{{asset('daterange/moment.min.js')}}"></script>
    <script src="{{asset('daterange/daterangepicker.min.js')}}"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon text-light rotate-15 ">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    <i class="fas fa-tree"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SI SAWIT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ ($title === "Dashboard" ? 'active' : '') }} ">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ ($title === "Petani" || $title === "Kendaraan" || $title === "Pekerja" ||$title === "Admin" ? 'active' : '') }}">
                <a class="nav-link {{$title === "Petani" || $title === "Kendaraan" || $title === "Pekerja" ||$title === "Admin" ? '' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-database"></i>
                    <span>Dataku</span>
                </a>
                <div id="collapseTwo" class="collapse {{$title === "Petani" || $title === "Kendaraan" || $title === "Pekerja" ||$title === "Admin" ? 'show' : ''}} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Dataku :</h6>
                        <a class="collapse-item {{ ($title === "Admin" ? 'active' : '') }}" href="/dashboard/admin">Admin</a>
                        <a class="collapse-item {{ ($title === "Kendaraan" ? 'active' : '') }}" href="/dashboard/car">Kendaraan</a>
                        <a class="collapse-item {{ ($title === "Pekerja" ? 'active' : '') }}" href="/dashboard/worker">Pekerja</a>
                        <a class="collapse-item {{ ($title === "Petani" ? 'active' : '') }}" href="/dashboard/farmer">Petani</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            {{-- <li class="nav-item {{ ($title === "Laporan" ? 'active' : '') }}">
                <a class="nav-link" href="/dashboard/laporan">
                    <i class="fas fa-flag"></i>
                    <span>Laporan</span></a>
            </li> --}}
            <!-- Divider -->
            {{-- <hr class="sidebar-divider my-0"> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ ($title === "Pembelian" ||$title === "Perbaikan" ||$title === "Penjualan" ||$title === "Bahan Bakar" ||$title === "Pinjaman" ? 'active' : '') }}">
                <a class="nav-link {{ ($title === "Pembelian" ||$title === "Perbaikan" ||$title === "Penjualan" ||$title === "Bahan Bakar" ||$title === "Pinjaman" ? '' : 'collapsed') }}" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-wallet"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseThree" class="collapse {{ ($title === "Pembelian" || $title === "Perbaikan" ||$title === "Penjualan" ||$title === "Bahan Bakar" ||$title === "Pinjaman" ? 'show' : '') }}" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaksi :</h6>
                        <a class="collapse-item {{ ($title === "Pembelian" ? 'active' : '') }}" href="/dashboard/purchase">Pembelian</a>
                        <a class="collapse-item {{ ($title === "Penjualan" ? 'active' : '') }}" href="/dashboard/sale">Penjualan</a>
                        <a class="collapse-item {{ ($title === "Bahan Bakar" ? 'active' : '') }}" href="/dashboard/fuel">Bahan Bakar</a>
                        <a class="collapse-item {{ ($title === "Perbaikan" ? 'active' : '') }}" href="/dashboard/repair">Perbaikan</a>
                        <a class="collapse-item {{ ($title === "Pinjaman" ? 'active' : '') }}" href="/dashboard/loan">Pinjaman</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ ($title === "Laporan" ? 'active' : '') }}">
                <a class="nav-link {{ ($title === "Laporan" ? '' : 'collapsed') }}" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-flag"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseFour" class="collapse {{ ($title === "Laporan Umum" || $title === "Laporan Khusus" ? 'show' : '') }}" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan :</h6>
                        <a class="collapse-item {{ ($title === "Laporan Umum" ? 'active' : '') }}" href="/dashboard/laporan-umum">Laporan Umum</a>
                        <a class="collapse-item {{ ($title === "Laporan Khusus" ? 'active' : '') }}" href="/dashboard/laporan-kusus">Laporan Khusus</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ ($title === "Ganti-Password" ? 'active' : '') }}">
                <a class="nav-link" href="/dashboard/ganti-password">
                    <i class="fas fa-unlock"></i>
                    <span>Ganti Password</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my">

            {{-- <!-- Nav Item - Dashboard -->
            <form action="/logout">
                @csrf
                <li class="nav-item">
                    <button type="submit" class="btn btn-primary btn-block">
                        <a class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span></a>
                </button>
            </li>
            </form>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li> --}}

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    {{-- <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button> --}}

                    <!-- Topbar Search -->
                    {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                            aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Jack Ramadhan</span>
                                <img class="img-profile rounded-circle" src="{{asset('template/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('container')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Jack Ramadhan 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
{{--
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="{{asset('sweetalert/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('sweetalert/myscript.js')}}"></script>
        {{-- <script src="{{asset('vendor/sweetalert/sweetalert.all.js.js')}}"></script> --}}
        <!-- Bootstrap Select -->
        <script src="{{asset('bselect/js/bootstrap-select.js')}}"></script>


</body>

</html>
