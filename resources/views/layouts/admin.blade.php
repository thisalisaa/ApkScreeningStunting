<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'APK-Screening')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('layout/src/assets/images/logos/favicon.png') }}" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('layout/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/admin_style.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('layout/src/assets/images/logos/logo.png') }}" width="180" alt="" />
                    </a>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span><i class="fas fa-home"></i></span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-puskesmas*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-puskesmas') }}">
                                <span><i class="fas fa-hospital"></i></span>
                                <span class="hide-menu">Data Puskesmas</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-posyandu*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-posyandu') }}">
                                <span><i class="fas fa-medkit"></i></span>
                                <span class="hide-menu">Data Posyandu</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-user*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-user') }}">
                                <span><i class="icon-user"></i></span>
                                <span class="hide-menu">Data User</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-faktor*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-faktor') }}">
                                <span><i class="fas fa-project-diagram"></i></span>
                                <span class="hide-menu">Data Faktor Stunting</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-himpunan*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-himpunan') }}">
                                <span><i class="far fa-list-alt"></i></span>
                                <span class="hide-menu">Data Himpunan Fuzzy</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-solusi*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-solusi') }}">
                                <span><i class="fas fa-notes-medical"></i></span>
                                <span class="hide-menu">Data Solusi</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.data-aturan*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.data-aturan') }}">
                                <span><i class="far fa-file-alt"></i></span>
                                <span class="hide-menu">Data Aturan</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.laporan') }}">
                                <span><i class="far fa-folder-open"></i></span>
                                <span class="hide-menu">Laporan</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Bagian Header -->
<div class="body-wrapper">
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Breadcrumb -->
            <div class="breadcrumb-container me-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i> 
                            </a>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
            <!-- Ikon Bell dan Profile -->
            <ul class="navbar-nav ms-auto">
                <!-- Ikon Bell -->
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                    </a>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('layout/src/assets/images/profile/user-1.jpg') }}"
                            alt="" width="35" height="35" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="drop2">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Content -->
    <div class="container-fluid">
        @yield('content')
    </div>
</div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('layout/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('layout/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('layout/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('frontend/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });


    </script>

    @stack('scripts')
</body>

</html>