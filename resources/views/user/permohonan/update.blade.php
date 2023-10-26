@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>HAI - Ubah Permohonan</title>
@endsection


{{-- navbar --}}
@section('navbar')
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                            class="fas fa-search"></i></a></li>
            </ul>
            <div class="search-element">

                <div class="search-backdrop"></div>
                <div class="search-result">
                    <div class="search-header">
                        Histories
                    </div>
                    <div class="search-item">
                        <a href="#">How to hack NASA using CSS</a>
                        <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="search-item">
                        <a href="#">Kodinger.com</a>
                        <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="search-item">
                        <a href="#">#Helpdesk HAI Kejati Jateng</a>
                        <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="search-header">
                        Result
                    </div>
                    <div class="search-item">
                        <a href="#">
                            <img class="mr-3 rounded" width="30"
                                src="{{ asset('template/main/dist/') }}assets/img/products/product-3-50.png" alt="product">
                            oPhone S9 Limited Edition
                        </a>
                    </div>
                    <div class="search-item">
                        <a href="#">
                            <img class="mr-3 rounded" width="30"
                                src="{{ asset('template/main/dist/') }}assets/img/products/product-2-50.png" alt="product">
                            Drone X2 New Gen-7
                        </a>
                    </div>
                    <div class="search-item">
                        <a href="#">
                            <img class="mr-3 rounded" width="30"
                                src="{{ asset('template/main/dist/') }}assets/img/products/product-1-50.png" alt="product">
                            Headphone Blitz
                        </a>
                    </div>
                    <div class="search-header">
                        Projects
                    </div>
                    <div class="search-item">
                        <a href="#">
                            <div class="search-icon bg-danger text-white mr-3">
                                <i class="fas fa-code"></i>
                            </div>
                            Stisla Admin Template
                        </a>
                    </div>
                    <div class="search-item">
                        <a href="#">
                            <div class="search-icon bg-primary text-white mr-3">
                                <i class="fas fa-laptop"></i>
                            </div>
                            Create a new Homepage Design
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <ul class="navbar-nav navbar-right">

            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                    class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifications
                        <div class="float-right">
                            <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Template update is available now!
                                <div class="time text-primary">2 Min Ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon bg-info text-white">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                <div class="time">10 Hours Ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon bg-success text-white">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                <div class="time">12 Hours Ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon bg-danger text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Low disk space. Let's clean it!
                                <div class="time">17 Hours Ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon bg-info text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Welcome to Stisla template!
                                <div class="time">Yesterday</div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('data/profile_photo/' . $profile_photo) }}"
                        class="rounded-circle mr-1">

                    <div class="d-sm-none d-lg-inline-block">Hi, {{ session('name') }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Logged in 5 min ago</div>
                    <a href="features-profile.html" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>

                    <a href="features-settings.html" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Settings
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
                        <li><a class="nav-link" href="{{ route('allPermohonan') }}">Semua Permohonan</a></li>
                        <li><a class="nav-link" href="{{ route('processPermohonan') }}">Permohonan Proses</a></li>
                        <li><a class="nav-link" href="{{ route('successPermohonan') }}">Permohonan Selesai</a></li>
                        <li><a class="nav-link" href="{{ route('failedPermohonan') }}">Permohonan
                                ditolak</a></li>

                    </ul>
                </li>



            </ul>

        </aside>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="container-fluid">

        </div>
        <section class="section">
            <div class="section-header">
                <h1>Ubah Permohonan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Ubah Permohonan</div>

                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah Permohonan</h2>
                <p class="section-lead"><i class="fa-regular fa-clock"></i> {{ $dataPermohonan['created_at'] }}</p>


                <div class="row">

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">

                            <div class="card-header">
                                <h4>Data Permohonan</h4>
                            </div>
                            <form action="{{ route('updateData') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="row">

                                        <div class="form-group col-md-7 col-12">
                                            <label>Nama</label>
                                            <input required type="text" class="form-control" required readonly
                                                value="{{ $dataPermohonan['nama'] }}">

                                            <input required hidden name="permohonan_id" type="text"
                                                class="form-control" required readonly
                                                value="{{ $dataPermohonan['permohonan_id'] }}">
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>Bidang</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{ $nama_bidang }}">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>Email</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{ $dataPermohonan['email'] }}">

                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>Tipe</label>
                                            <select name="type_id" required class="form-control">
                                                <option selected value="{{ $dataPermohonan['type_id'] }}">
                                                    {{ $dataPermohonan['nama_type'] }}</option>

                                                @foreach ($data_type as $dt)
                                                    @if ($dt->type_id == $dataPermohonan['type_id'])
                                                        <option hidden value="{{ $dt->type_id }}">{{ $dt->nama_type }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $dt->type_id }}">{{ $dt->nama_type }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Layanan</label>

                                            <select required name="layanan_id" class="form-control">
                                                <option selected value="{{ $dataPermohonan['layanan_id'] }}">
                                                    {{ $dataPermohonan['nama_layanan'] }}</option>

                                                @foreach ($data_layanan as $dl)
                                                    @if ($dl->layanan_id == $dataPermohonan['layanan_id'])
                                                        <option hidden value="{{ $dl->layanan_id }}">
                                                            {{ $dl->nama_layanan }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $dl->layanan_id }}">{{ $dl->nama_layanan }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Subjek</label>
                                            <input required name="subject" type="text" class="form-control"
                                                value="{{ $dataPermohonan['subject'] }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">

                                            <label>File Pendukung (<span class="text-danger">10MB | .pdf, .jpg, .png,
                                                    .jpeg</span>)</label>
                                            <input type="file" name="evidence" class="form-control"
                                                accept=".pdf, .jpg, .png, .jpeg">
                                            @if ($dataPermohonan['file'] != null)
                                                <label><a
                                                        href="{{ route('downloadFilePermohonan', $dataPermohonan['file']) }}"><span
                                                            class="text-primary">{{ $dataPermohonan['file'] }}</span></a></label>
                                            @else
                                                <p>Tidak ada file pendukung.</p>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Keterangan</label>
                                            <textarea required name="description" required class="form-control" rows="7">{{ $dataPermohonan['keterangan'] }}</textarea>

                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-right">

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>


    </div>


    </section>



    </div>
@endsection
