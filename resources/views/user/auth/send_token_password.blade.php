<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('template/auth/user/style.css') }}">
    <title>Reset Kata Sandi - Helpdesk HAI Kejati Jateng</title>
</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-in">
            <form method="POST" action="{{ route('resetPassword') }}">
                @csrf
                <h1>Lupa Kata Sandi?</h1>
                <input name="email" type="email" required placeholder="Email" value="{{ old('email') }}">
                @if (session('failed'))
                    <span style="color: red">{{ session('failed') }}</span>
                @elseif (session('success'))
                    <span style="color: #00923F">{{ session('success') }}</span>
                @endif

                <button type="submit">Kirim Link</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">

                <div class="toggle-panel toggle-right">
                    <h1>Reset Kata Sandi!</h1>
                    <p>Kami akan mengirimkan link url ke alamat Email Anda untuk mereset kata sandi Anda.</p>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/auth/user/script.js') }}"></script>
</body>

</html>
