<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Title & Favicon --}}
    <title>GMF PLB REPORT</title>
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

        <nav class="main-header navbar navbar-expand navbar-light bg-navbar">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/home" class="nav-link">Dashboard</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <img src="./img/default.png" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

                        <li class="user-header bg-plb">
                            <img src="./img/default.png" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>{{ Auth::user()->username }}</small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="btn btn-default btn-flat float-right"><i
                                    class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <div class="brand-link d-flex justify-content-between align-items-center">
                <a href="#" class="brand-link">
                    <img src="{{ asset('/img/logo-gmf.png') }}" alt="Logo GMF AeroAsia"
                        class="brand-image" style="opacity: .8">
                    <span class="brand-text ">GMF PLB REPORT</span>
                </a>
            </div>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <li class="nav-item">
                            <router-link to="/home" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                                </a>
                        </li>
                        <li class="nav-header"> Report</li>

                        <!-- BEGIN: Dokumen Kepabeanan -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-lines"></i>
                                <p>
                                    Dokumen Kepabeanan
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/dokumen-pemasukan" class="nav-link">
                                        <p>Dokumen Pemasukan PLB</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/dokumen-pengeluaran" class="nav-link">
                                        <p>Dokumen Pengeluaran PLB</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: Dokumen Kepabeanan -->

                        <!-- BEGIN: Outbound -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                                <p>
                                    Outbound
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/transaksi-outbound" class="nav-link">
                                        <p>Transaksi Outbound</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/summary-outbound" class="nav-link">
                                        <p>Summary Outbound</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: Outbound -->

                        <!-- BEGIN: Mutasi Pesawat -->
                        <li class="nav-item ">
                            <router-link to="/mutation" class="nav-link">
                                <i class="nav-icon fa-solid fa-plane-circle-exclamation"></i>
                                <p>
                                    Mutasi Pesawat
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </router-link>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/delivery" class="nav-link">
                                        <p>Aircraft Delivery</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/redelivery" class="nav-link">
                                        <p>Aircraft Redelivery</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: Mutasi Pesawat -->

                        <!-- BEGIN: Allotment -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-warehouse"></i>
                                <p>
                                    Allotment
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/inventory-allotment" class="nav-link">
                                        <p>Inventory Allotment</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/movement-allotment" class="nav-link">
                                        <p>Movement Allotment</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: Allotment -->

                        <!-- BEGIN: Mutasi -->
                        <li class="nav-item ">
                            <a href="#" class=" nav-link">
                                <i class="nav-icon fa-solid fa-file-circle-exclamation"></i>
                                <p>Mutasi<i class="right fas fa-angle-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/report-mutasi" class="nav-link">
                                        <p>Report Mutasi</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/mutasi-berkala" class="nav-link">
                                        <p>Report Mutasi Berkala</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/perhitungan-mutasi" class="nav-link">
                                        <p>Report Perhitungan Mutasi</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: Mutasi -->
                        <!-- BEGIN: Scrap -->
                        <li class="nav-item">
                            <router-link to="/scrap" class="nav-link">
                                <i class="nav-icon fa-solid fa-oil-well"></i>
                                <p>Scrap</p>
                            </router-link>
                        </li>
                        <!-- END: Scrap -->

                        <!-- BEGIN: Masa Timbun -->
                        <li class="nav-item">
                            <router-link to="/masa-timbun" class="nav-link">
                                <i class="nav-icon fa-solid fa-hands-holding-circle"></i>
                                <p>Masa Timbun</p>
                            </router-link>
                        </li>
                        <!-- END: Masa Timbun -->
                        <!-- <li class="nav-header">Master Data</li> -->
                        <!-- BEGIN: Data Upload -->
                        <!-- <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-cloud-arrow-up"></i>
                                <p>Data Upload<i class="right fas fa-angle-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Mutasi</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Barang BC 3.0</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Header BC 3.0</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Dokumen BC 3.0</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Scan Dokumen</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Stok Opname</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Data Movement OSA</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>Install/Consume OSA</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>List Movement to OSA</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="#" class="nav-link">
                                        <p>List Install/Consume OSA
                                        </p>
                                    </router-link>
                                </li>
                            </ul>
                        </li> -->
                        <!-- END: Data Upload -->

                        <li class="nav-header">Miscellaneous</li>
                        <!-- BEGIN: User Management -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-gear"></i>
                                <p> User Management<i class="right fas fa-angle-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/users-list" class="nav-link">
                                        <p>Daftar Pengguna</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/users-role" class="nav-link">
                                        <p>Role Pengguna</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: User Management -->
                        <!-- BEGIN: Log -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-server"></i>
                                <p>
                                    Log
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/login-history" class="nav-link">
                                        <p>Login History</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/activity-history" class="nav-link">
                                        <p>Activity History</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <!-- END: Log -->

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                                <p class="text">Keluar</p>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <router-view></router-view>
            <vue-progress-bar></vue-progress-bar>
        </div>

        {{-- <footer class="main-footer">
            <div class="container-fluid">

                <div class="row text-center">
                    <div class="d-none d-sm-inline">
                        Copyright &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> PT GMF AeroAsia Tbk. All Rights Reserved
                    </div>
                </div>
            </div>
        </footer> --}}
    </div>
</body>


</html>