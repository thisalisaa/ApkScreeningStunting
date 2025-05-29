<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Verifikasi Kode')</title>

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
        
        <!-- Form Input Kode Verifikasi -->
        <form action="{{ route('verify.email', ['token' => $user->verification_token]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="verification_code">Masukkan Kode Verifikasi</label>
                <input type="text" name="verification_code" id="verification_code" class="form-control" required maxlength="6">
            </div>
    
            <button type="submit" class="btn btn-primary mt-3">Verifikasi</button>
        </form>
    </div>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
