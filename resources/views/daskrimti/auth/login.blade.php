@extends('layouts.admin.auth.t_auth')

@section('title')
    <title>Masuk - Daskrimti</title>
@endsection
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Halo Daskrimti</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('daskrimtiLogin') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                        required autofocus>

                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Kata Sandi</label>

                                    </div>
                                    <input id="password" minlength="8" type="password" class="form-control"
                                        name="password" tabindex="2" required>

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
                                        Masuk
                                    </button>
                                </div>


                            </form>

                            <div class=" text-muted text-center">
                                Lupa kata sandi? <a href="auth-register.html">Reset kata sandi</a>
                            </div>


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
