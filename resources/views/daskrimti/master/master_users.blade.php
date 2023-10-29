@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>Daskrimti - Pengguna</title>
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
                <a href="{{ route('daskrimtiDashboard') }}">HAI Kejati Jateng</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('daskrimtiDashboard') }}">HAI</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li>
                    <a href="{{ route('daskrimtiDashboard') }}"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Data Permohonan</li>
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
                <li class="menu-header">Data Master</li>
                <li class="active" class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa-solid fa-wrench"></i> <span>Data Master</span></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a class="nav-link" href="{{ route('layanan') }}">Data Pengguna</a></li>
                        <li><a class="nav-link" href="{{ route('layanan') }}">Data Layanan</a></li>
                        <li><a class="nav-link" href="{{ route('bidang') }}">Data Bidang</a>
                        <li class="active"><a class="nav-link" href="{{ route('type') }}">Data Tipe</a></li>

                    </ul>

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
                <h1>Daftar Semua Staff</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('daskrimtiDashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Staff</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Daftar Semua Staff</h2>
                <p class="section-lead">Daftar semua staff yang ada.</p>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">


                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"><i
                                    class="fa-regular fa-plus"></i> Tambah
                                Staff</button>

                            <div class="table-responsive mt-3">
                                <table class="table table-striped" id="table_type">
                                    <thead>

                                        <th>No</th>
                                        <th>NRP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Bidang</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dataUsers as $dtlyn)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $dtlyn->nrp }}</td>
                                                <td>{{ $dtlyn->name }}</td>
                                                <td>{{ $dtlyn->email }}</td>
                                                <td>{{ $dtlyn->nama_bidang }}</td>
                                                <td>
                                                    @if ($dtlyn->status == 1)
                                                        <div class="badge badge-success">Aktif</div>
                                                    @else
                                                        <div class="badge badge-danger">Tidak Aktif</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-warning mr-2" data-toggle="modal"
                                                            data-target="#modal_update_{{ $dtlyn->user_id }}"><i
                                                                class="fa-regular fa-pen-to-square"></i></button>
                                                        <button data-user_id="{{ $dtlyn->user_id }}"
                                                            class="btn btn-danger btnDelete"><i
                                                                class="fa-regular fa-trash-can"></i></a>

                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>




        </section>
        @foreach ($dataUsers as $dtyyn)
            {{-- Modal update --}}
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_update_{{ $dtyyn->user_id }}">
                <div class="modal-dialog " role="document">
                    <div class="modal-content modal-dialog-scrollable">
                        <form action="{{ route('updateUsers') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Data Staff</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-12">
                                    <label>NRP</label>
                                    <input type="number" hidden required name="user_id" value="{{ $dtyyn->user_id }}"
                                        class="form-control">
                                    <input type="number" required name="nrp" value="{{ $dtyyn->nrp }}"
                                        class="form-control">
                                </div>

                                <div class="form-group col-12">
                                    <label>Nama Lengkap</label>
                                    <input required name="name" value="{{ $dtyyn->name }}" class="form-control">
                                </div>

                                <div class="form-group col-12">
                                    <label>Email</label>
                                    <input type="email" required name="email" value="{{ $dtyyn->email }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-12">
                                    <label>Bidang</label>
                                    <select required name="bidang_id" class="form-control">
                                        <option value="{{ $dtyyn->bidang_id }}" selected>{{ $dtyyn->nama_bidang }}
                                        </option>
                                        @foreach ($dataBidang as $dtb)
                                            @if ($dtb->bidang_id == $dtyyn->bidang_id)
                                                <option hidden value="{{ $dtb->bidang_id }}">{{ $dtb->nama_bidang }}
                                                </option>
                                            @else
                                                <option value="{{ $dtb->bidang_id }}">{{ $dtb->nama_bidang }}</option>
                                            @endif
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group col-12">
                                    <label>Status</label>
                                    <select required name="status" class="form-control">
                                        @if ($dtb->status == 1)
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        @elseif ($dtb->status == 0)
                                            <option value="0" selected>Tidak Aktif</option>
                                            <option value="1">Aktif</option>
                                        @endif
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endforeach


        {{-- Modal insert --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_insert">
            <div class="modal-dialog " role="document">
                <div class="modal-content modal-dialog-scrollable">
                    <form action="{{ route('insertUser') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Staff Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-12">
                                <label>NRP</label>
                                <input type="number" required name="nrp" value="" class="form-control">
                            </div>

                            <div class="form-group col-12">
                                <label>Nama Lengkap</label>
                                <input required name="name" value="" class="form-control">
                            </div>

                            <div class="form-group col-12">
                                <label>Email</label>
                                <input type="email" required name="email" value="" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Bidang</label>
                                <select required name="bidang_id" class="form-control">
                                    @foreach ($dataBidang as $dtb)
                                        <option value="{{ $dtb->bidang_id }}">{{ $dtb->nama_bidang }}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
