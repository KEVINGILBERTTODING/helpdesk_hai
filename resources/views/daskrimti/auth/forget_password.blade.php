@extends('layouts.admin.auth.t_auth')

@section('title')
    <title>Daskrimti - Lupa Kata Sandi</title>
@endsection
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Lupa Kata Sandi Anda?</h4>

                        </div>

                        <div class="card-body">

                            <form method="get" action="{{ route('sendResetPasswordToken') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" required="Email tidak boleh kosong" type="email"
                                        class="form-control" name="email" tabindex="1" required autofocus>

                                </div>


                                @if (session('failed'))
                                    <div class="mb-3 text-danger">
                                        {{ session('failed') }}
                                    </div>
                                @elseif (session('success'))
                                    <div class="mb-3 text-primary">
                                        {{ session('success') }}
                                    </div>
                                @endif



                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Kirim token
                                    </button>
                                </div>


                            </form>

                            <p>Sistem akan mengirimkan token reset kata sandi pada alamat email, jadi
                                pastikan email yang Anda masukkan valid dan terdaftar pada sistem.</p>



                        </div>
                    </div>

                    <div class="simple-footer">
                        Copyright &copy; Kejaksaan Tinggi Jawa Tengah
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
