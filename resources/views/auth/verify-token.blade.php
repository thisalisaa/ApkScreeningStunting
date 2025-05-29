<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Verifikasi Akun')</title>

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
        
        <!-- Form Input Token -->
        <form method="POST" action="{{ route('token.verify') }}">
            @csrf

            <!-- Token -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="token" class="form-control @error('token') is-invalid @enderror" type="text" name="token" required placeholder="Masukkan Token">
                </div>
                @error('token')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">
                Verifikasi Token
            </button>
        </form>
    </div>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
