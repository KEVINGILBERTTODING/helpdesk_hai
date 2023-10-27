<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('template/auth/user/style.css') }}">
    <title>Ubah Kata Sandi - Helpdesk HAI Kejati Jateng</title>
</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-in">
            <form method="POST" action="{{ route('updatePassword') }}">
                @csrf
                <h1>Kata Sandi Baru</h1>
                <input type="text" name="user_id" hidden value="{{ $userId }}">
                <input name="new_password" type="password" required placeholder="Password Baru"
                    value="{{ old('new_password') }}">
                <input name="password_verify" type="password" required placeholder="Konfirmasi Password"
                    value="{{ old('password_verify') }}">
                @if (session('failed'))
                    <span style="color: red">{{ session('failed') }}</span>
                @elseif (session('success'))
                    <span style="color: #00923F">{{ session('success') }}</span>
                @endif

                <button type="submit">Simpan</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">

                <div class="toggle-panel toggle-right">
                    <h1>Ubah Kata Sandi</h1>
                    <p>Masukkan kata sandi baru Anda.</p>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/auth/user/script.js') }}"></script>
</body>

</html>
