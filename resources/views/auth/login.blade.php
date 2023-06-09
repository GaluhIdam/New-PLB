@extends('layouts.guest')

@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/home">
                <img alt="GMF AeroAsia" src="img/gmf-logo.png">
            </a>
            <h3 class="title">GMF PLB REPORT</h3>
        </div>
        <div class="login-card">
            <p class="login-box-msg">Masuk untuk Melanjutkan</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- BEGIN: Username -->
                <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        id="username" value="{{ old('username') }}" placeholder="Masukan Username anda" autofocus>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <!-- END: Username -->

                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Masukan Password anda" autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember_me" name="remember_me" {{ old('remember_me') ? 'checked'
                                : '' }}>
                            <label for="remember_me">
                                Ingat Saya
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- <p class="mb-1">
          <a href="/forgot">Lupa Password?</a>
        </p>
        <p class="mb-0">
          <a href="/register" class="text-center">Daftar</a>
        </p> -->
        </div>
        <div class="login-footer">
            <span>Copyright © 2022 GMF AeroAsia</span>
        </div>
    </div>
</div>
@endsection