<!DOCTYPE html>
<html>

<head>
    @include('layouting.guest._partials.headers')
</head>
<form action="{{ route('login.process') }}" method="POST">
    @csrf

    <body class="login-page">
        <div class="login-header box-shadow">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="brand-logo">
                    {{-- Logo bisa dimasukkan di sini jika diperlukan --}}
                </div>
                {{-- <div class="login-menu">
                <ul>
                    <li><a href="{{ route('register') }}">Register</a></li> <!-- Link ke Register dengan route -->
                </ul>
            </div> --}}
            </div>
        </div>

        <!-- Wrap seluruh form ke tengah halaman -->
        <div class="login-wrap min-vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="login-box bg-white box-shadow border-radius-10 p-4">
                    <div class="login-title">
                        <h2 class="text-center text-primary">AM.Bintang Manage</h2>
                    </div>
                    <form method="POST" action="{{ route('login.process') }}"> <!-- Route untuk login -->
                        @csrf
                        <!-- Select Role -->
                        <div class="select-role text-center mb-3">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn active">
                                    <input type="radio" name="role" id="admin" value="kasir" checked>
                                    <div class="icon"><img src="assets/guest/vendors/images/briefcase.svg"
                                            class="svg" alt=""></div>
                                    <span>Sebagai</span> Kasir
                                </label>
                                <label class="btn">
                                    <input type="radio" name="role" id="user" value="pemilik">
                                    <div class="icon"><img src="assets/guest/vendors/images/person.svg" class="svg"
                                            alt=""></div>
                                    <span>Sebagai</span> Pemilik
                                </label>
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="input-group custom mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Username"
                                name="username" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="input-group custom mb-3">
                            <input type="password" class="form-control form-control-lg" placeholder="**********"
                                name="password" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="row pb-3">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1"
                                        name="remember">
                                    <label class="custom-control-label" for="customCheck1">Ingat Saya</label>
                                </div>
                            </div>
                            {{-- <div class="col-6 text-right">
                            <a href="{{ route('password.request') }}">Lupa Kata Sandi</a> <!-- Link ke halaman reset password -->
                        </div> --}}
                        </div>

                        <!-- Sign In Button -->
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
                        </div>

                        <!-- OR Divider -->
                        <div class="text-center font-16 font-weight-bold pb-2">ATAU</div>

                        <!-- Register Button -->
                        {{-- <div class="input-group mb-0">
                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('register') }}">Daftar untuk Membuat Akun</a> <!-- Link ke halaman register -->
                    </div> --}}
                    </form>
                </div>
            </div>
        </div>

        @include('layouting.guest._partials.scripts')
    </body>

</html>
