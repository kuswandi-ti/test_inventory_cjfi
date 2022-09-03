<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Dashboard</title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </form>

                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Session::get('sess_username') }}</div></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item has-icon text-danger">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Logout</button>
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="{{ route('home') }}">Inventory System</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="{{ route('home') }}">IS</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="menu-header">Home</li>
                            <li><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

                            <li class="menu-header">Master</li>
                            <li><a class="nav-link" href="{{ route('barang.index') }}"><i class="fas fa-th-large"></i> <span>Barang</span></a></li>

                            <li class="menu-header">Transaksi</li>
                            <li><a class="nav-link" href="{{ route('barangmasuk_index') }}"><i class="fas fa-shopping-basket"></i> <span>Barang Masuk</span></a></li>
                            <li><a class="nav-link" href="{{ route('barangkeluar_index') }}"><i class="fas fa-share-square"></i> <span>Barang Keluar</span></a></li>

                            <li class="menu-header">Report</li>
                            <li><a class="nav-link" href="{{ route('stock_index') }}"><i class="fas fa-layer-group"></i> <span>Stok</span></a></li>
                        </ul>
                    </aside>
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>{{ $page_title }}</h1>
                            <div class="section-header-breadcrumb">
                                <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
                                <div class="breadcrumb-item active">{{ $breadcrumb }}</div>
                            </div>
                        </div>

                        @yield('content')
                    </section>
                </div>

                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2022 <div class="bullet"></div> Develop By <strong>Kuswandi</strong>
                    </div>
                    <div class="footer-right">
                        2.3.0
                    </div>
                </footer>
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/stisla.js') }}"></script>

        <!-- JS Libraies -->
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <!-- Page Specific JS File -->
        @yield('js_file')
    </body>
</html>
