@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>Daskrimti - Dashboard</title>
@endsection


{{-- navbar --}}
@section('navbar')
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

            </ul>

        </form>
        <ul class="navbar-nav navbar-right">

            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('data/profile_photo/' . $dataDaskrimti['profile_photo']) }}"
                        class="rounded-circle mr-1">

                    <div class="d-sm-none d-lg-inline-block">Hi, {{ $dataDaskrimti['name'] }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <a href="{{ route('profileDaskrimti') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('daskrimtiLogOut') }}" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
@endsection


{{-- sidebar --}}
@section('sidebar')
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ route('daskrimtiDashboard') }}">HAI Kejati Jateng</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('daskrimtiDashboard') }}">HAI</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="active">
                    <a href="{{ route('daskrimtiDashboard') }}"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Data Permohonan</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa-solid fa-folder"></i> <span>Permohonan</span></a>
                    <ul class="dropdown-menu">

                        <li><a class="nav-link" href="{{ route('semuaPermohonan') }}">Semua Permohonan</a>
                        <li><a class="nav-link" href="{{ route('prosesPermohonan') }}">Permohonan Proses</a></li>
                        <li><a class="nav-link" href="{{ route('selesaiPermohonan') }}">Permohonan Selesai</a></li>
                        <li><a class="nav-link" href="{{ route('ditolakPermohonan') }}">Permohonan ditolak</a></li>

                    </ul>

                </li>
                <li class="menu-header">Data Master</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa-solid fa-layer-group"></i> <span>Data Master</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('users') }}">Data Staff</a></li>
                        <li><a class="nav-link" href="{{ route('layanan') }}">Data Layanan</a></li>
                        <li><a class="nav-link" href="{{ route('bidang') }}">Data Bidang</a>
                        <li><a class="nav-link" href="{{ route('type') }}">Data Tipe</a></li>

                    </ul>

                </li>
                <li class="menu-header">Pengaturan</li>
                <li>
                    <a href="{{ route('pengaturan') }}"><i class="fa-solid fa-wrench"></i></i>
                        <span>Pengaturan Website</span></a>
                </li>
                <li class="menu-header">Akun</li>
                <li>
                    <a href="{{ route('profileDaskrimti') }}"><i class="fa-solid fa-user"></i> <span>Profil</span></a>
                </li>



            </ul>

        </aside>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Daskrimti</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('semuaPermohonan') }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fa-regular fa-folder fa-2xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Permohonan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalPermohonan }}
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('selesaiPermohonan') }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fa-solid fa-check fa-2xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Permohonan selesai</h4>
                                </div>
                                <div class="card-body">
                                    {{ $permohonanValid }}

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('prosesPermohonan') }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fa-solid fa-hourglass fa-2xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Permohonan Proses</h4>
                                </div>
                                <div class="card-body">
                                    {{ $permohonanProses }}

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('ditolakPermohonan') }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Permohonan ditolak</h4>
                                </div>
                                <div class="card-body">
                                    {{ $permohonanTidakValid }}

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

        </section>
    </div>
@endsection
