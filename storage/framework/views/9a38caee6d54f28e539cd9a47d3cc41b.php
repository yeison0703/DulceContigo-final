<?php $__env->startSection('content'); ?>
<style>
    .productos-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 28px;
        justify-content: center;
        margin-top: 28px;
    }
    .producto-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10);
        border: 1px solid #e0e0e0;
        padding: 18px 14px 16px 14px;
        width: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .producto-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(21, 64, 27, 0.18);
        border-color: #c28e00;
    }
    .producto-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 12px;
        border: 1.5px solid #c28e00;
        background: #f6f6f6;
    }
    .producto-card h5 {
        font-size: 1.08rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: #15401b;
        text-align: center;
    }
    .producto-card p {
        font-size: 1rem;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }
    .producto-card .btn {
        background: #15401b;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.2s;
        padding: 6px 18px;
        margin: 0 4px;
    }
    .producto-card .btn:hover {
        background: #c28e00;
        color: #15401b;
    }
    .producto-card .btn-carrito {
        background: #c28e00;
        color: #15401b;
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 1.2rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 4px;
        transition: background 0.2s, color 0.2s;
    }
    .producto-card .btn-carrito:hover {
        background: #15401b;
        color: #fff;
    }
    .producto-card .btns-group {
        display: flex;
        justify-content: center;
        gap: 6px;
        width: 100%;
        margin-top: 4px;
    }
</style>
<div class="container">
    <h2 style="text-align: center; color:#15401b; margin-top: 18px;">
        Estos son nuestros deliciosos <?php echo e($categoria->nombre); ?>

    </h2>
    <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-dark">Volver al catálogo</a>
    <?php if($productos->isEmpty()): ?>
        <p style="text-align: center">No hay productos disponibles en esta categoría.</p>
        <br>
    <?php else: ?>
    <div class="productos-grid">
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="producto-card">
            <img src="<?php echo e(asset('storage/' . $producto->imagen)); ?>" alt="imagen del producto">
            <h5><?php echo e($producto->nombre); ?></h5>
            <p>$<?php echo e($producto->precio); ?></p>
            <div class="btns-group">
                <a href="<?php echo e(route('producto.show',$producto->id)); ?>" class="btn">Ver</a>
                <button type="button" class="btn-carrito" title="Agregar al carrito">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
    <br>
    
</div>
<br>
<br>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    function agregarAlCarrito(id, nombre, precio, imagen) {
        const existente = carrito.find(p => p.id === id);
        if (existente) {
            existente.cantidad += 1;
        } else {
            carrito.push({id, nombre, precio, imagen, cantidad: 1});
        }
        localStorage.setItem('carrito', JSON.stringify(carrito));
        if (window.actualizarContadorCarrito) {
            window.actualizarContadorCarrito();
        }
        Swal.fire({
            icon: 'success',
            title: '¡Agregado!',
            text: 'El producto se agregó al carrito.',
            timer: 1000,
            showConfirmButton: false
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-carrito').forEach(function(btn, idx) {
            btn.addEventListener('click', function() {
                const producto = <?php echo json_encode($productos, 15, 512) ?>[idx];
                agregarAlCarrito(producto.id, producto.nombre, producto.precio, producto.imagen);
            });
        });
    });

    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Yeison\Pictures\Instagram_files\dulcecontigo-copia-ACTULIZADO 23 DE MAYO\resources\views/categorias/productos.blade.php ENDPATH**/ ?>