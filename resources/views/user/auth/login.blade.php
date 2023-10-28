<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('template/auth/user/style.css') }}">
    <title>Login - Helpdesk HAI Kejati Jateng</title>
</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login_user') }}">
                @csrf
                <h1>Masuk</h1>

                <input name="nrp" required placeholder="NRP">
                <input name="password" type="password" required minlength="8" placeholder="Kata sandi">

                @if (session('error'))
                    <span style="color: red">{{ session('error') }}</span>
                @elseif (session('success'))
                    <span style="color: #00923F">{{ session('success') }}</span>
                @endif
                <a href="{{ route('forgetPassword') }}">Lupa kata sandi Anda?</a>
                <button type="submit">Masuk</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">

                <div class="toggle-panel toggle-right">
                    <h1>Selamat Datang Kembali!</h1>
                    <p>Helpdesk HAI Kejati Jateng.</p>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/auth/user/script.js') }}"></script>
</body>

</html>
