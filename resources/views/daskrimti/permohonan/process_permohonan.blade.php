@extends('layouts.user.main.t_main')

{{-- Title --}}
@section('title')
    <title>Daskrimti - Permohonan Proses</title>
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
                <li>
                    <a href="{{ route('daskrimtiDashboard') }}"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Data Permohonan</li>
                <li class="dropdown active">
                    <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                            class="fa-regular fa-folder"></i> <span>Permohonan</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('semuaPermohonan') }}">Semua Permohonan</a>
                        <li class="active"><a class="nav-link" href="{{ route('prosesPermohonan') }}">Permohonan Proses</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('selesaiPermohonan') }}">Permohonan Selesai</a></li>
                        <li><a class="nav-link" href="{{ route('ditolakPermohonan') }}">Permohonan ditolak</a></li>


                    </ul>

                </li>
                <li class="menu-header">Data Master</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa-solid fa-layer-group"></i><span>Data Master</span></a>
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
                <h1>Daftar Permohonan Proses</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('daskrimtiDashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Permohonan Proses</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Daftar Permohonan Proses</h2>
                <p class="section-lead">Daftar Permohonan sedang di Proses.</p>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info" data-target="#modal_filter" data-toggle="modal"><i
                                        class="fa-solid fa-filter"></i> Filter</button>
                            </div>



                            <div class="table-responsive mt-3">
                                <table class="table table-striped" id="table-layanan">
                                    <thead>

                                        <th>No</th>
                                        <th>Tanggal Permohonan</th>
                                        <th>NRP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Subjek</th>
                                        <th>Layanan</th>
                                        <th>Bidang</th>
                                        <th>Tipe</th>
                                        <th>Keterangan</th>
                                        <th>Berkas Pendukung</th>
                                        <th>Status</th>
                                        <th>File Balasan</th>
                                        <th>Balasan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dataPermohonan as $dtlyn)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $dtlyn->created_at }}</td>
                                                <td>{{ $dtlyn->nrp }}</td>
                                                <td>{{ $dtlyn->nama_lengkap }}</td>
                                                <td>{{ $dtlyn->subject }}</td>
                                                <td>{{ $dtlyn->nama_layanan }}</td>
                                                <td>{{ $dtlyn->nama_bidang }}</td>
                                                <td>{{ $dtlyn->nama_type }}</td>
                                                <td>{{ $dtlyn->keterangan }}</td>
                                                <td>
                                                    @if ($dtlyn->file != null)
                                                        <a href="{{ route('downloadFilePermohonan', $dtlyn->file) }}"
                                                            class="btn btn-primary btn-sm">Unduh berkas</a>
                                                    @else
                                                        Tidak ada berkas.
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dtlyn->status == 1)
                                                        <div class="badge badge-success">Selesai</div>
                                                    @elseif ($dtlyn->status == 2)
                                                        <div class="badge badge-warning">Proses</div>
                                                    @else
                                                        <div class="badge badge-danger">Ditolak</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dtlyn->file_balasan != null)
                                                        <a href="{{ route('downloadFileBalasan', $dtlyn->file_balasan) }}"
                                                            class="btn btn-primary btn-sm">Unduh file balasan</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dtlyn->balasan != null)
                                                        {{ $dtlyn->balasan }}
                                                    @else
                                                        Belum ada balasan.
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-success mr-2" data-toggle="modal"
                                                            data-target="#modal_accept_{{ $dtlyn->permohonan_id }}"><i
                                                                class="fa-solid fa-check"></i></button>

                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal_reject_{{ $dtlyn->permohonan_id }}"><i
                                                                class="fa-solid fa-times"></i></button>
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

        @foreach ($dataPermohonan as $dtyyn)
            {{-- Modal accept --}}

            <div class="modal fade" tabindex="-1" role="dialog" id="modal_accept_{{ $dtyyn->permohonan_id }}">
                <div class="modal-dialog " role="document">
                    <div class="modal-content modal-dialog-scrollable">
                        <form action="{{ route('acceptPermohonan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Permohonan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-12" hidden>
                                    <input type="number" readonly hidden required name="permohonan_id"
                                        value="{{ $dtyyn->permohonan_id }}" class="form-control">
                                </div>
                                <div class="form-group col-12" hidden>
                                    <input type="email" readonly hidden required name="email"
                                        value="{{ $dtyyn->email }}" class="form-control">
                                </div>

                                <div class="form-group col-12" hidden>
                                    <input type="number" required name="user_id" hidden value="{{ $dtyyn->user_id }}"
                                        class="form-control">
                                </div>

                                <div class="form-group col-12">
                                    <label>File Balasan</label>
                                    <input type="file" name="file" class="form-control" accept=".pdf">
                                    <span class="text text-sm text-warning" style="margin-top: 10px;">Format .pdf | ukuran
                                        5 MB</span>
                                </div>

                                <div class="form-group col-12">
                                    <label>Balasan Permohonan</label>
                                    <textarea required name="balasan" required class="form-control" rows="7">{{ $dtyyn->balasan }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            {{-- Modal reject --}}
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_reject_{{ $dtyyn->permohonan_id }}">
                <div class="modal-dialog " role="document">
                    <div class="modal-content modal-dialog-scrollable">
                        <form action="{{ route('rejectPermohonan') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Tolak Permohonan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-12" hidden>
                                    <input type="number" readonly hidden required name="permohonan_id"
                                        value="{{ $dtyyn->permohonan_id }}" class="form-control">

                                </div>
                                <div class="form-group col-12" hidden>
                                    <input type="email-" readonly hidden required name="email"
                                        value="{{ $dtyyn->email }}" class="form-control">
                                </div>

                                <div class="form-group col-12" hidden>
                                    <input type="number" required name="user_id" hidden value="{{ $dtyyn->user_id }}"
                                        class="form-control">
                                </div>




                                <div class="form-group col-12">
                                    <label>Balasan Permohonan</label>

                                    <textarea required name="balasan" required class="form-control" rows="7">{{ $dtyyn->balasan }}</textarea>
                                </div>




                            </div>

                            <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        @endforeach


        {{-- modal filter --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_filter">
            <div class="modal-dialog " role="document">
                <div class="modal-content modal-dialog-scrollable">
                    <form action="{{ route('filterPermohonan') }}" method="get">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Filter Permohonan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-12" hidden>
                                <input type="number" hidden required name="status" value="2"
                                    class="form-control">

                            </div>
                            <div class="form-group col-12">
                                <label>Tanggal Awal</label>

                                <input type="date" required name="date_from" class="form-control">
                            </div>

                            <div class="form-group col-12">
                                <label>Tanggal Akhir</label>
                                <input type="date" required name="date_end" class="form-control">
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
                            <button type="submit" class="btn btn-primary">Filter</button>
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
            $('#table-layanan').DataTable();
        });
    </script>
    <script>
        $(document).on('click', '.btnDelete', function() {
            var layanan_id = $(this).data('layanan_id');
            swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Data yang telah dihapus tidak dapat dipulihkan kembali!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = '/deleteLayanan/' + layanan_id;
                    } else {
                        // Tindakan yang diambil jika pengguna membatalkan penghapusan
                    }
                });
        });
    </script>
@endsection
