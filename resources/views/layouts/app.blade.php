<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    .logo{
        margin-left: 30px;
    }
    .logo img{
        height: 70px;
        border-radius: 100px;
    }
    .navbar {
    background: linear-gradient(90deg, rgb(15, 46, 27), rgb(20, 65, 38), rgb(18, 56, 32));
        box-shadow: 0 4px 6px rgba(21, 64, 27, 0.15);
    }
    .navbar-nav .nav-link {
        color: #fff !important;
        font-size: 1rem;
        font-weight: 600;
        transition: color 0.3s, transform 0.3s;
        text-align: center;
    }
    .navbar-nav .nav-link:hover,
    .navbar .nav-link.active {
        color: #c28e00 !important; 
        background: transparent !important;
        border-radius: 8px;
        transform: scale(1.08);
    }
    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff !important;
        text-shadow: 1px 1px 0 #15401b;
    }
    .navbar-brand:hover {
        color: #c28e00 !important;
        transform: scale(1.1);
    }
    
    .navbar-toggler {
        border: none;
        background: #15401b !important;
        border-radius: 8px;
        padding: 6px 10px;
    }
    .navbar-toggler .navbar-toggler-icon {
        background-image: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 1.8em;
        height: 1.8em;
        padding: 0;
    }
    .navbar-toggler .navbar-toggler-icon span {
        display: block;
        height: 3px;
        width: 28px;
        background: #c28e00;
        margin: 5px 0;
        border-radius: 2px;
        transition: all 0.3s;
    }
    
    @media (max-width: 991.98px) {
        .navbar-collapse {
            text-align: center;
        }
        .navbar-nav {
            margin: 0 auto !important;
            float: none !important;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar-nav .nav-item {
            margin-bottom: 10px;
        }
    }
    .btn-outline-dark {
        border: 2px solid #15401b !important;
        color: #15401b !important;
        font-weight: 600;
        border-radius: 8px;
        transition: background 0.2s, color 0.2s;
    }
    .btn-outline-dark:hover {
        background: #c28e00 !important;
        color: #fff !important;
        border-color: #c28e00 !important;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/a2/1c/a6/dulcecontigo.jpg" alt="">
                @auth
                    <span class="ms-3 fw-bold text-white" style="font-size:1.1rem;">
                        {{ Auth::user()->name }}
                    </span>
                @endauth
            </a>
            <a class="navbar-brand" href="{{ url('/') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carrito.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span id="contador-carrito" class="badge" style="background-color:#c28e00; color:#fff; margin-left:4px;">0</span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Iniciar Sesión</a></li>
                    @endguest

                    @auth
                        <li class="nav-item"><a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('categorias*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">Categorías</a></li>
                        <li class="nav-item">
                            <a class="nav-link{{ request()->is('pedidos') ? ' active' : '' }}" href="{{ url('/pedidos') }}">
                                <i class="bi bi-list-ul"></i> Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Cerrar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                Registrar usuario
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script>
function actualizarContadorCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let total = carrito.reduce((sum, prod) => sum + prod.cantidad, 0);
    let badge = document.getElementById('contador-carrito');
    if (badge) {
        badge.textContent = total;
    }
}

// Actualiza al cargar la página
document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);

// Permite que otras vistas lo llamen después de agregar productos
window.actualizarContadorCarrito = actualizarContadorCarrito;
</script>
</body>
</html>