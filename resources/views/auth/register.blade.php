@extends('layouts.app')

@section('content')
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    /* Quitar borde azul y personalizar input como el login */
    .form-control:focus {
        border-color: #15401b;
        box-shadow: none;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        box-shadow: none;
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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirmar contraseña') }}</label>
                    <input id="password-confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
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
@endsection
