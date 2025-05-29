<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Akun Anda</title>
</head>
<body>
    <h1>Halo {{ $user->nama }}</h1>
    <p>Terima kasih telah mendaftar. Berikut adalah detail akun Anda:</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Password:</strong> Silakan login menggunakan password yang telah ditetapkan saat pendaftaran. Anda dapat mengubahnya setelah login pertama kali.</p>
    <p>Untuk melanjutkan, silakan klik tombol di bawah ini untuk memverifikasi akun Anda dengan memasukkan kode verifikasi yang terlampir di email ini:</p>
    <p><a href="{{ route('verify.page', ['token' => $user->verification_token]) }}" style="background-color: #1fab89; color: white; padding: 10px 20px; text-decoration: none;">Verifikasi Akun</a></p>
    <p>Token ini berlaku selama 24 jam. Jika Anda tidak melakukan pendaftaran ini, silakan abaikan email ini.</p>
</body>
</html>
