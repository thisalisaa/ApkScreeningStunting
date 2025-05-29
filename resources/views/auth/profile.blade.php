@extends('layouts.petugas_posyandu')

@section('title', 'Distributor P4C Tracking')
@section('setting', 'active-sub')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .file {
        position: relative;
        overflow: hidden;
        margin-top: 15px;
    }
    .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }
    .invalid {
        color: red;
    }
    .valid {
        color: green;
    }
    .my-custom-alert {
        border-radius: 10px;
        width: 470px;
        height: auto;
        padding: 20px;
        font-size: 13px;
    }
    .profile-img-container {
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #eee;
    }
    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .info-password {
        padding-left: 20px;
        margin-top: 10px;
    }
    .info-password li {
        margin-bottom: 5px;
    }
    .panel-body {
        padding: 25px;
    }
    .form-section {
        margin-bottom: 30px;
    }
    .password-form .row > div {
        margin-bottom: 15px;
    }
</style>

<div class="card">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <h4 class="text-bold">Ganti Password</h4>
                <div class="panel-body">

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Profil berhasil diubah, silakan login kembali.',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                customClass: { popup: 'my-custom-alert' }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('logout') }}";
                                }
                            });
                        </script>
                    @endif

                    @if ($errors->any())
                        <script>
                            Swal.fire({
                                title: 'Gagal!',
                                text: '{{ implode(' ', $errors->all()) }}',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                customClass: { popup: 'my-custom-alert' }
                            });
                        </script>
                    @endif

                    <div class="form-section">
                        <form method="POST" action="{{ route('profile.edit', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="profile">

                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="profile-img-container">
                                        <img class="profile-img"
                                             src="{{ $user->user_foto ? asset('storage/uploads/fotoDataUser/' . $user->user_foto) : asset('layout/src/assets/images/profile/user-1.jpg') }}"
                                             alt="User Photo" id="img1">
                                    </div>
                                    <div class="file btn btn-info">
                                        GANTI FOTO
                                        <input accept="image/*" name="user_foto" type="file" id="imgInp1">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-main text-bold">Email</p>
                                            <p>{{ $user->user_email }}</p>
                                        </div>

                                        <div class="col-sm-4">
                                            <p class="text-main text-bold">Role</p>
                                            <p>{{ $user->user_status }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="form-section">
                        <h4 class="text-bold">Ganti Password</h4>
                        <form method="POST" action="{{ route('profile.edit') }}" class="password-form">
                            @csrf

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="text-main text-bold">Password Lama</p>
                                    <input type="password" name="current_password" class="form-control" placeholder="Password Lama" required>
                                </div>

                                <div class="col-sm-4">
                                    <p class="text-main text-bold">Password Baru</p>
                                    <input type="password" name="new_password" id="newPassword" class="form-control" placeholder="Password Baru" required
                                           onfocus="document.getElementById('pswd_info').style.display='block';"
                                           onblur="document.getElementById('pswd_info').style.display='none';">
                                </div>

                                <div class="col-sm-4">
                                    <p class="text-main text-bold">Konfirmasi Password</p>
                                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="pswd_info" style="display:none; margin-top: 20px;">
                                        <h5>Password harus memenuhi:</h5>
                                        <ul class="info-password">
                                            <li id="letter" class="invalid">Minimal <strong>1 huruf kecil</strong></li>
                                            <li id="capital" class="invalid">Minimal <strong>1 huruf kapital</strong></li>
                                            <li id="number" class="invalid">Minimal <strong>1 angka</strong></li>
                                            <li id="length" class="invalid">Minimal <strong>8 karakter</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-info">GANTI PASSWORD</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    document.getElementById("imgInp1").onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            document.getElementById("img1").src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    var passwordInput = document.getElementById("newPassword");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    passwordInput.onkeyup = function() {
        var lowerCaseLetters = /[a-z]/g;
        letter.classList.toggle("valid", passwordInput.value.match(lowerCaseLetters));
        letter.classList.toggle("invalid", !passwordInput.value.match(lowerCaseLetters));

        var upperCaseLetters = /[A-Z]/g;
        capital.classList.toggle("valid", passwordInput.value.match(upperCaseLetters));
        capital.classList.toggle("invalid", !passwordInput.value.match(upperCaseLetters));

        var numbers = /[0-9]/g;
        number.classList.toggle("valid", passwordInput.value.match(numbers));
        number.classList.toggle("invalid", !passwordInput.value.match(numbers));

        length.classList.toggle("valid", passwordInput.value.length >= 8);
        length.classList.toggle("invalid", passwordInput.value.length < 8);
    }
</script>
@endsection