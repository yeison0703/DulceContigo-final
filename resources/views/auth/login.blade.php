@extends('layouts.app')

@section('content')
<!-- Font Awesome para el icono del ojo -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        background: #eefaf3;
    }
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border-radius: 18px;
        box-shadow: 0 8px 32px 0 rgba(28, 90, 36, 0.12);
        border: none;
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 430px;
        width: 100%;
    }
    .login-card .card-header {
        background: #15401b;
        color: #fff;
        border-radius: 16px 16px 0 0;
        font-size: 1.5rem;
        text-align: center;
        font-weight: 600;
        letter-spacing: 1px;
        border: none;
        margin-bottom: 1.5rem;
        padding: 1.2rem 1rem;
    }
    .form-control:focus {
        border-color: #15401b !important; /* Verde oscuro */
        box-shadow: 0 0 0 0.2rem rgba(21, 64, 27, 0.15) !important; /* Sombra verde */
    }
    .btn-primary {
        background: #15401b;
        border: none;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-primary:focus {
        box-shadow: none !important;
        outline: none !important;
    }
    .btn-primary:hover {
        background: #c28e00;
        color: #fff;
    }
    .btn-link {
        color: #c28e00;
        font-weight: 500;
    }
    .btn-link:hover {
        color: #15401b;
        text-decoration: underline;
    }
    .register-link {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        font-size: 1rem;
        color: #15401b;
    }
    .register-link a {
        color: #c28e00;
        font-weight: 600;
        text-decoration: none;
        margin-left: 4px;
    }
    .register-link a:hover {
        color: #15401b;
        text-decoration: underline;
    }
    /* Estilos para el icono del ojo */
    .password-wrapper {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #15401b;
        z-index: 2;
        font-size: 1.1em;
    }
</style>
<div class="login-container">
    <div class="login-card card">
        <div class="card-header">{{ __('Login') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        <span toggle="#password" class="fa fa-eye toggle-password"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection