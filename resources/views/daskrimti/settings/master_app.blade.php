@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>Daskrimti - Pengaturan</title>
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
                        <span>Pengaturan Aplikasi</span></a>
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
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Advanced Forms</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Advanced Forms</h2>
                <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

                <div class="row">
                    {{-- Form edit data about us --}}
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Tentang Aplikasi</h4>
                            </div>
                            <form action="{{ route('updateAboutUs') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" value="{{ $dataApp['email'] }}" name="email" required
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" value="{{ $dataApp['telp'] }}" name="telepon" required
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Link Instagram</label>
                                        <input type="text" value="{{ $dataApp['url_instagram'] }}"
                                            name="url_instagram" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Link Facebook</label>
                                        <input type="text" name="url_facebook" value="{{ $dataApp['url_facebook'] }}"
                                            required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Link X</label>
                                        <input type="text" value="{{ $dataApp['url_x'] }}" name="url_x" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar tentang aplikasi 1</label>
                                        <input type="file" class="form-control" name="img_about_us1"
                                            accept=".jpg,.png,.jpeg">
                                        <p class="text-primary">{{ $dataApp['img_about_us1'] }}</p>


                                    </div>

                                    <div class="form-group">
                                        <label>Gambar tentang aplikasi 2</label>
                                        <input type="file" class="form-control" name="img_about_us2"
                                            accept=".jpg,.png,.jpeg">
                                        <p class="text-primary">{{ $dataApp['img_about_us2'] }}</p>


                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi aplikasi</label>
                                        <textarea type="text" name="app_desc" required class="form-control">{{ $dataApp['about_us'] }}</textarea>

                                    </div>


                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        {{-- Form edit data footer --}}
                        <div class="card">
                            <div class="card-header">
                                <h4>Footer</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="control-label">Toggle switches</div>
                                    <div class="custom-switches-stacked mt-2">
                                        <label class="custom-switch">
                                            <input type="radio" name="option" value="1"
                                                class="custom-switch-input" checked>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Option 1</span>
                                        </label>
                                        <label class="custom-switch">
                                            <input type="radio" name="option" value="2"
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Option 2</span>
                                        </label>
                                        <label class="custom-switch">
                                            <input type="radio" name="option" value="3"
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Option 3</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">Toggle switch single</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">I agree with terms and conditions</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Form edit data banner --}}
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Banner</h4>
                            </div>

                            <form action="{{ route('updateBanner') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="section-title">Banner Pertama</div>
                                    <div class="form-group">
                                        <label>Header</label>
                                        <textarea type="text" name="header1" required class="form-control">{{ $dataApp['header1'] }}</textarea>

                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" name="header_desc1" required class="form-control">{{ $dataApp['header_desc1'] }}</textarea>

                                    </div>

                                    <div class="form-group">
                                        <label>Banner</label>
                                        <input type="file" class="form-control" name="img_banner1"
                                            accept=".jpg,.png,.jpeg">
                                        <p class="text-primary">{{ $dataApp['img_banner1'] }}</p>


                                    </div>

                                    <div class="section-title">Banner Kedua</div>
                                    <div class="form-group">
                                        <label>Header</label>
                                        <textarea type="text" name="header2" required class="form-control">{{ $dataApp['header2'] }}</textarea>

                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" name="header_desc2" required class="form-control">{{ $dataApp['header_desc2'] }}</textarea>

                                    </div>

                                    <div class="form-group">
                                        <label>Banner</label>
                                        <input type="file" class="form-control" name="img_banner2"
                                            accept=".jpg,.png,.jpeg">
                                        <p class="text-primary">{{ $dataApp['img_banner2'] }}</p>


                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan Perubahan</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
    </div>
    </div>
    </section>
    </div>
@endsection
@section('sweet_alert')
    <script>
        $(document).ready(function() {
            $('#table_type').DataTable();
        });
    </script>
    <script>
        $(document).on('click', '.btnDelete', function() {
            var user_id = $(this).data('user_id');
            swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Data yang telah dihapus tidak dapat dipulihkan kembali!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = '/deleteUser/' + user_id;
                    } else {
                        // Tindakan yang diambil jika pengguna membatalkan penghapusan
                    }
                });
        });
    </script>
@endsection
