<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Login Akun</h1>
            <div class="logo">
                <img src="{{ asset('assets/images/favicon.png') }}" width="50" alt="">
            </div>
            <p>Silakan login akun untuk melanjutkan</p>
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

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
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

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
                        Lihat password
                    </label>
                    <a href="{{ route('register') }}" class="forgot-password">Belum punya akun?</a>
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="login-button">Login</button>
                    <a href="{{ url('/') }}" class="back-button">Kembali</a>
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
                    window.location.href = "{{ url('/products') }}"; // ganti sesuai route 
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
