@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>HAI - Dashboard</title>
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

            @php
                $isExist = false;
            @endphp

            {{-- Cek apakah ada notif baru --}}
            @foreach ($dataNotification as $dtnotif)
                @if ($dtnotif->is_read == 0)
                    @php
                        $isExist = true;
                    @endphp
                @endif
            @endforeach

            {{-- Jika ada notif baru --}}
            @if ($isExist == true)
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                        class="nav-link notification-toggle nav-link-lg beep "><i class="far fa-bell"></i></a>
                @else
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                        class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
            @endif


            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifikasi

                    @if (!$dataNotification->isEmpty())
                        <div class="float-right">
                            <a href="{{ route('deleteNotification') }}">Hapus semua</a>
                        </div>
                    @endif

                </div>
                <div class="dropdown-list-content dropdown-list-icons">


                    @foreach ($dataNotification as $dn)
                        @if ($dn->is_read == 1)
                            <a href="{{ route('detailPermohonan', Crypt::encrypt($dn->permohonan_id)) }}"
                                class="dropdown-item">
                            @else
                                <a href="{{ route('detailPermohonan', Crypt::encrypt($dn->permohonan_id)) }}"
                                    class="dropdown-item dropdown-item-unread">
                        @endif

                        {{-- Mengubah warna dan icon --}}
                        @if ($dn->type == 1)
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-check"></i>
                            </div>
                        @else
                            <div class="dropdown-item-icon bg-danger text-white">
                                <i class="fas fa-times"></i>

                            </div>
                        @endif

                        {{-- Mengubah isi notifiation --}}
                        <div class="dropdown-item-desc">
                            @if ($dn->type == 1)
                                Permohonan Anda telah selesai!
                            @else
                                Permohonan Anda ditolak!
                            @endif

                            @if ($dn->is_read == 0)
                                <div class="time text-primary">{{ $dn->created_at }}</div>
                            @else
                                <div class="time text-secondary">{{ $dn->created_at }}</div>
                            @endif
                        </div>
                        </a>
                    @endforeach



                </div>
                @if ($isExist == true)
                    <div class="dropdown-footer text-center">
                        <a href="{{ route('markAllRead') }}">Tandai semua telah dibaca</a>
                    </div>
                @endif


            </div>
            </li>
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('data/profile_photo/' . $dataUser['profile_photo']) }}"
                        class="rounded-circle mr-1">

                    <div class="d-sm-none d-lg-inline-block">Hi, {{ $dataUser['name'] }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
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
                <a href="{{ route('dashboard') }}">HAI Kejati Jateng</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('dashboard') }}">HAI</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="active">
                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Data</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa-regular fa-folder"></i> <span>Permohonan Saya</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('createPermohonan') }}">Permohonan Baru</a></li>
                        <li><a class="nav-link" href="{{ route('allPermohonan') }}">Semua Permohonan</a>
                        <li><a class="nav-link" href="{{ route('processPermohonan') }}">Permohonan Proses</a></li>
                        <li><a class="nav-link" href="{{ route('successPermohonan') }}">Permohonan Selesai</a></li>
                        <li><a class="nav-link" href="{{ route('failedPermohonan') }}">Permohonan ditolak</a></li>

                    </ul>

                </li>
                <li class="menu-header">Akun</li>
                <li>
                    <a href="{{ route('profile') }}"><i class="fa-solid fa-user"></i> <span>Profil</span></a>
                </li>



            </ul>

        </aside>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('allPermohonan') }}">
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
                    <a href="{{ route('successPermohonan') }}">
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
                    <a href="{{ route('processPermohonan') }}">
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
                    <a href="{{ route('failedPermohonan') }}">
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
