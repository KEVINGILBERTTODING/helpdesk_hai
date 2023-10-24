@extends('layouts.user.auth.t_auth')

@section('title')
<title>Masuk</title>
@endsection

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="{{ asset('template/landing_page/img/img_login.png') }}"
               class="img-fluid" alt="Login image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form  action="{{ route('login_user') }}" method="POST">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example13">Email</label>
              <input name="email" type="email" id="form1Example13" class="form-control form-control-lg" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example23">Kata sandi</label>
              <input name="password" type="password" id="form1Example23" class="form-control form-control-lg" />
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="#!">Lupa kata sandi?</a>
            </div>

            @if (session('error'))
            <p>{{ session('error') }}</p>
            @endif



            <!-- Submit button -->
            <button type="submit" style="width: 100%; background-color: #00923F; color: white" type="submit" class="btn btn-lg btn-block">Masuk</button>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">Atau</p>
            </div>

            <div class="mt-2 mb-5 text-muted text-center">
            Belum memiliki akun? <a href="auth-register.html">Daftar</a>
              </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
