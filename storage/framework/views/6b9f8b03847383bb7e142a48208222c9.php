<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Encabezado con título y contador de pedidos de hoy -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color:#15401b;">Pedidos pendientes</h2>
        <div class="d-flex align-items-center">
            <span class="badge" style="background-color:#c28e00; color:#fff; font-size:1.1rem; padding:10px 18px;">
                Pedidos pendientes: <?php echo e($totalPedidosHoy ?? 0); ?>

            </span>
            <button type="button" class="btn ms-2 p-0" style="background:#c09624; color:#15401b; border-radius:50%; width:46px; height:46px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(194,142,0,0.13); border:2px solid #c28e00;" disabled>
                <i class="bi bi-cart-fill" style="font-size:1.7rem;"></i>
            </button>
        </div>
    </div>
    <?php if($pedidos->isEmpty()): ?>
        <!-- Mensaje si no hay pedidos -->
        <div class="alert alert-info text-center">
            No hay pedidos registrados.
        </div>
    <?php else: ?>
    <!-- Estilos personalizados para la tabla de pedidos -->
    <style>
        #pedidos-table {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10);
            overflow: hidden;
            font-size: 1rem;
        }
        #pedidos-table th {
            background: #15401b;
            color: #fff;
            text-align: center;
            font-weight: 700;
            border-bottom: 2px solid #c28e00;
            vertical-align: middle;
        }
        #pedidos-table td {
            vertical-align: middle;
            text-align: center;
            color: #222;
            background: #f9f9f9;
        }
        #pedidos-table tbody tr:hover {
            background: #eefaf3;
            transition: background 0.2s;
        }
        /* Estilo para el botón de confirmar pedido */
        .btn-success.btn-sm {
            background: #15401b;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            padding: 4px 10px;
            font-size: 1rem;
        }
        .btn-success.btn-sm:hover {
            background: #c28e00;
            color: #15401b;
        }
    </style>
    <div class="table-responsive">
        <!-- Tabla de pedidos -->
        <table id="pedidos-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Método de pago</th>
                    <th>Comentarios</th>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $contadorPorDia = [];
                ?>
                <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Calcular el total del pedido sumando precio * cantidad de cada producto
                        $total = 0;
                        $productos = json_decode($pedido->productos, true);
                        foreach($productos as $producto) {
                            $total += $producto['precio'] * $producto['cantidad'];
                        }

                        // Generar número de pedido: AAMMDD-XXX
                        $fechaClave = $pedido->created_at->format('Ymd');
                        if (!isset($contadorPorDia[$fechaClave])) {
                            $contadorPorDia[$fechaClave] = 1;
                        } else {
                            $contadorPorDia[$fechaClave]++;
                        }
                        $numeroPedido = $pedido->created_at->format('ymd') . '-' . str_pad($contadorPorDia[$fechaClave], 3, '0', STR_PAD_LEFT);
                    ?>
                    <tr id="pedido-<?php echo e($pedido->id); ?>">
                        <td class="fw-bold" style="color:#15401b;"><?php echo e($numeroPedido); ?></td>
                        <td><?php echo e($pedido->nombre); ?></td>
                        <td><?php echo e($pedido->telefono); ?></td>
                        <td>
                            <!-- Mostrar método de pago como badge -->
                            <span class="badge" style="background:#15401b; color:#fff;"><?php echo e($pedido->metodo_pago); ?></span>
                        </td>
                        <td><?php echo e($pedido->comentarios); ?></td>
                        <td>
                            <!-- Listado de productos del pedido -->
                            <ul class="mb-0 ps-3" style="font-size: 0.97rem;">
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <span class="fw-semibold" style="color:#15401b;"><?php echo e($producto['nombre']); ?></span>
                                        x<?php echo e($producto['cantidad']); ?>

                                        <span class="text-muted">($<?php echo e(number_format($producto['precio'], 2)); ?> c/u)</span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                        <!-- Total del pedido -->
                        <td class="fw-bold text-success" style="font-size:1.15rem;">
                            $<?php echo e(number_format($total, 2)); ?>

                        </td>
                        <!-- Fecha de creación del pedido -->
                        <td><?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <!-- Botón para marcar el pedido como listo -->
                            <button type="button" class="btn btn-success btn-sm btn-confirmar-pedido" data-id="<?php echo e($pedido->id); ?>">
                                <i class="fa fa-check"></i> Listo
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<!-- SweetAlert2 para confirmación de acción -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Asignar evento a todos los botones de confirmar pedido
    document.querySelectorAll('.btn-confirmar-pedido').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            // Mostrar alerta de confirmación
            Swal.fire({
                title: '¿Seguro que este pedido está listo?',
                text: 'Esta acción moverá el pedido al historial.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, está listo',
                cancelButtonText: 'Cancelar',
                customClass: { confirmButton: 'btn btn-success', cancelButton: 'btn btn-secondary' },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar petición POST al backend para marcar como completado
                    fetch('/pedidos/' + id + '/completar', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.ok){
                            // Eliminar la fila del pedido de la tabla
                            document.getElementById('pedido-' + id).remove();
                            // Mostrar mensaje de éxito
                            Swal.fire({
                                icon: 'success',
                                title: '¡Pedido marcado como listo!',
                                confirmButtonText: 'Aceptar',
                                customClass: { confirmButton: 'btn btn-success' },
                                buttonsStyling: false
                            });
                        }
                    });
                }
            });
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DulceContigo-final\resources\views/pedidos/index.blade.php ENDPATH**/ ?>