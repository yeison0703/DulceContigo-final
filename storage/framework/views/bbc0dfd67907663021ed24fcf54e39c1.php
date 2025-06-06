<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .logo {
            margin-left: 30px;
        }

        .logo img {
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

        .navbar .dropdown-menu {
            background: linear-gradient(90deg, rgb(15, 46, 27), rgb(20, 65, 38), rgb(18, 56, 32));
            border-radius: 8px;
            border: none;
            min-width: 180px;
        }

        .navbar .dropdown-menu .dropdown-item {
            color: #fff;
            /* Siempre blanco */
            font-weight: 500;
            transition: background 0.3s, color 0.2s;
        }

        .navbar .dropdown-menu .dropdown-item:hover,
        .navbar .dropdown-menu .dropdown-item:focus {
            background-color: #c28e00;
            color: #fff;
        }

        /* Quitar fondo azul al item activo del dropdown */
        .navbar .dropdown-menu .dropdown-item.active,
        .navbar .dropdown-menu .dropdown-item:active {
            background-color: #c28e00 !important;
            color: #fff !important;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="<?php echo e(url('/pedidos')); ?>" class="logo d-flex align-items-center" style="text-decoration: none">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/a2/1c/a6/dulcecontigo.jpg" alt="">
                <?php if(auth()->guard()->check()): ?>
                    <span class="ms-3 fw-bold text-white" style="font-size:1.1rem;"> Bienvenido
                        <?php echo e(Auth::user()->name); ?>

                    </span>
                <?php endif; ?>
            </a>


            <?php if(auth()->guard()->guest()): ?>

                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">Dulce Contigo</a>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>"
                                href="<?php echo e(url('/')); ?>">Inicio</a>
                        </li>
                        <!-- Lista desplegable Productos -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProductos" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProductos">
                                <li><a class="dropdown-item" href="<?php echo e(route('categorias.producto', 1)); ?>">Postres</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('categorias.producto', 4)); ?>">Dulces</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('categorias.producto', 2)); ?>">Conservas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('carrito.index')); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <span id="contador-carrito" class="badge"
                                    style="background-color:#c28e00; color:#fff; margin-left:4px;">0</span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Iniciar Sesión</a></li>
                    <?php endif; ?>

                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item"><a class="nav-link <?php echo e(request()->is('productos*') ? 'active' : ''); ?>"
                                href="<?php echo e(route('productos.index')); ?>">Productos</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo e(request()->is('categorias*') ? 'active' : ''); ?>"
                                href="<?php echo e(route('categorias.index')); ?>">Categorías</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle<?php echo e(request()->is('pedidos') ? ' active' : ''); ?>"
                                href="#" id="navbarDropdownPedidos" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-list-ul"></i> Pedidos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownPedidos">
                                <li>
                                    <a class="dropdown-item<?php echo e(request()->is('pedidos') ? ' active' : ''); ?>"
                                        href="<?php echo e(url('/pedidos')); ?>">
                                        Pedidos pendientes
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?php echo e(request()->is('pedidos/historial') ? ' active' : ''); ?>"
                                        href="<?php echo e(url('/pedidos/historial')); ?>">
                                        Historial de pedidos
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('register') ? 'active' : ''); ?>"
                                href="<?php echo e(route('register')); ?>">
                                Registrar usuario
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Cerrar
                                Sesión</a>
                        </li>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
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
<?php /**PATH C:\Users\Yeison\Desktop\DulceContigo-final\resources\views/layouts/app.blade.php ENDPATH**/ ?>