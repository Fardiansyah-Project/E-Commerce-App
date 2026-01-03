<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SnikerStore</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Daftar Akun</h1>
            <div class="logo">
                <img src="{{ asset('assets/images/favicon.png') }}" width="50" alt="">
            </div>
            <p>Silakan buat akun untuk melanjutkan</p>
        </div>

        <div class="login-body">

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert success" id="alert">
                    {{ session('success') }}
                </div>
            @elseif ($errors->has('error'))
                <div class="alert error" id="alert">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('register.store') }}">
                @csrf
                <input type="hidden" value="CUSTOMER" id="role" name="role">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama" autocomplete="off">
                    @error('name')
                        <div class="alert-error" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Masukkan email" autocomplete="off">
                    @error('email')
                        <div class="alert-error" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password"
                        autocomplete="current-password">
                    @error('password')
                        <div class="alert-error" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Masukkan password" autocomplete="current-password">
                    @error('password_confirmation')
                        <div class="alert-error" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
                        Lihat password
                    </label>
                    <a href="{{ route('login') }}" class="forgot-password">Sudah punya akun?</a>
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="login-button">Daftar</button>
                    <a href="{{ url('/login') }}" class="back-button">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const alertBox = document.getElementById('alert');
        if (alertBox) {
            alertBox.style.display = 'block';

            if (alertBox.classList.contains('success')) {
                setTimeout(() => {
                    window.location.href = "{{ url('/login') }}"; // ganti sesuai route dashboard Anda
                }, 2500);
            }

            // setTimeout(() => {
            //     alertBox.style.opacity = '0';
            // }, 3000);
        }

        // Show / hide password
        function togglePasswordVisibility() {
            const pass = document.getElementById("password");
            pass.type = pass.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>
