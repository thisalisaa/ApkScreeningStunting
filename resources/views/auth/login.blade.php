<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'APK-Screening')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('layout/src/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">

</head>

<body>
    <div class="login-container">
        <!-- Logo Aplikasi -->
        <div>
            <img src="{{ asset('layout/src/assets/images/logos/playing.png') }}" alt="Logo Aplikasi">
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="text"
                        name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                        placeholder="Email">
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                        name="password" required autocomplete="current-password" placeholder="Password">
                    <span class="show-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="form-group d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">
                        {{ __('Remember me') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            {{ __('Lupa password') }}
                        </a>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-login">
                {{ __('Log in') }}
            </button>
        </form>
    </div>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Password Toggle Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>  