@extends('layouts.app')

@section('content')
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Font Awesome para el icono del ojo -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .register-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .register-card {
        width: 100%;
        max-width: 430px;
        margin: 0 auto;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        border: 1px solid #e0e0e0;
    }
    .register-card .card-header {
        background: #15401b;
        color: #fff;
        font-weight: bold;
        text-align: center;
        border-radius: 16px 16px 0 0;
        font-size: 1.3rem;
    }
    .btn-primary {
        background: #15401b;
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover {
        background: #c28e00;
        color: #fff;
    }
    .form-label {
        color: #15401b;
        font-weight: 600;
    }
    .form-control:focus {
        border-color: #15401b;
        box-shadow: none;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        box-shadow: none;
    }
    /* Estilos para el icono del ojo dentro del input */
    .password-wrapper {
        position: relative;
    }
    .password-wrapper .form-control {
        padding-right: 2.5rem;
    }
    .toggle-password {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #15401b;
        z-index: 2;
        font-size: 1.2em;
        background: transparent;
        border: none;
        padding: 0;
        display: flex;
        align-items: center;
    }
</style>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#15401b'
    });
</script>
@endif

<div class="register-container">
    <div class="register-card card">
        <div class="card-header">{{ __('Registrar usuario') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nombre') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                        <span class="fa fa-eye toggle-password" onclick="togglePassword('password', this)"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirmar contraseña') }}</label>
                    <div class="password-wrapper">
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                        <span class="fa fa-eye toggle-password" onclick="togglePassword('password-confirm', this)"></span>
                    </div>
                </div>

                <div class="d-grid gap-2 mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, el) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        el.classList.remove('fa-eye');
        el.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        el.classList.remove('fa-eye-slash');
        el.classList.add('fa-eye');
    }
}
</script>
@endsection
