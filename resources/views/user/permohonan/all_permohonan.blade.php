@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>HAI - Semua Permohonan</title>
@endsection


{{-- navbar --}}
@section('navbar')
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto" action="{{ route('search') }}" method="get">
            @csrf

            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                            class="fas fa-search"></i></a></li>
            </ul>

            <div class="search-element">
                <input class="form-control" type="search" required name="query" placeholder="Search" aria-label="Search"
                    data-width="250">
                <input class="form-control" name="status" hidden type="search" value="3" aria-label="Search"
                    data-width="250">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </div>
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
                <li>
                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Data</li>
                <li class="dropdown active">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa-regular fa-folder"></i> <span>Permohonan Saya</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('createPermohonan') }}">Permohonan Baru</a>
                        </li>
                        <li class="active"><a class="nav-link" href="{{ route('allPermohonan') }}">Semua Permohonan</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('processPermohonan') }}">Permohonan Proses</a></li>
                        <li><a class="nav-link" href="{{ route('successPermohonan') }}">Permohonan Selesai</a></li>
                        <li><a class="nav-link" href="{{ route('failedPermohonan') }}">Permohonan
                                ditolak</a></li>

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
                <h1>Daftar Semua Permohonan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Semua Permohonan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Daftar Semua Permohonan</h2>
                <p class="section-lead">Daftar semua permohonan yang telah Anda kirimkan.</p>

                <div class="row">
                    @foreach ($dataPermohonan as $dp)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="article article-style-b">
                                <div class="article-header">
                                    <div class="article-image"
                                        data-background="
                                        @if ($dp->status == 1) {{ asset('template/main/dist/assets/img/news/img12.jpg') }}
                                        @elseif ($dp->status == 2)
                                        {{ asset('template/main/dist/assets/img/news/img09.jpg') }}
                                        @elseif ($dp->status == 0)
                                        {{ asset('template/main/dist/assets/img/news/img10.jpg') }} @endif
                                        ">
                                    </div>
                                    <div class="article-badge">
                                        @if ($dp->status == 1)
                                            <div class="article-badge-item bg-success"><i class="fa-solid fa-check"></i>
                                                Selesai
                                            </div>
                                        @elseif ($dp->status == 2)
                                            <div class="article-badge-item bg-warning"><i
                                                    class="fa-solid fa-hourglass"></i>
                                                Proses
                                            </div>
                                        @elseif ($dp->status == 0)
                                            <div class="article-badge-item bg-danger"><i class="fa-solid fa-xmark"></i>
                                                ditolak
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="article-details">
                                    <p class="text-sm" style="font-size: 12px;">{{ $dp->created_at }}</p>
                                    <div class="article-title">
                                        <h2><a href="#">{{ $dp->subject }}</a></h2>
                                    </div>
                                    @if ($dp->keterangan)
                                        @if (strlen($dp->keterangan) > 94)
                                            <p>{{ substr($dp->keterangan, 0, 94) }}...</p>
                                        @else
                                            <p>{{ $dp->keterangan }}</p>
                                        @endif
                                    @endif

                                    <div class="article-cta">

                                        <a href="{{ route('detailPermohonan', Crypt::encrypt($dp->permohonan_id)) }}">Lihat
                                            detail
                                            <i class="fas fa-chevron-right"></i></a>

                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach

                </div>
            </div>

        </section>
    </div>
@endsection
