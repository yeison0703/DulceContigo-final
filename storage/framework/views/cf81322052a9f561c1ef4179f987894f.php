

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color:#15401b;">Pedidos</h2>
        <span class="badge" style="background-color:#c28e00; color:#fff; font-size:1.1rem; padding:10px 18px;">
            Pedidos hoy: <?php echo e($totalPedidosHoy ?? 0); ?>

        </span>
    </div>
    <?php if($pedidos->isEmpty()): ?>
        <div class="alert alert-info text-center">
            No hay pedidos registrados.
        </div>
    <?php else: ?>
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
                <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $total = 0;
                    $productos = json_decode($pedido->productos, true);
                    foreach($productos as $producto) {
                        $total += $producto['precio'] * $producto['cantidad'];
                    }
                ?>
                <tr id="pedido-<?php echo e($pedido->id); ?>">
                    <td class="fw-bold" style="color:#15401b;"><?php echo e($pedido->id); ?></td>
                    <td><?php echo e($pedido->nombre); ?></td>
                    <td><?php echo e($pedido->telefono); ?></td>
                    <td>
                        <span class="badge" style="background:#15401b; color:#fff;"><?php echo e($pedido->metodo_pago); ?></span>
                    </td>
                    <td><?php echo e($pedido->comentarios); ?></td>
                    <td>
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
                    <td class="fw-bold text-success" style="font-size:1.15rem;">
                        $<?php echo e(number_format($total, 2)); ?>

                    </td>
                    <td><?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></td>
                    <td>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-confirmar-pedido').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Seguro que este pedido está listo?',
                text: 'Esta acción eliminará el pedido de la lista.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, está listo',
                cancelButtonText: 'Cancelar',
                customClass: { confirmButton: 'btn btn-success', cancelButton: 'btn btn-secondary' },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/pedidos/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.ok){
                            document.getElementById('pedido-' + id).remove();
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Yeison\Pictures\Instagram_files\dulcecontigo-copia-ACTULIZADO 23 DE MAYO\resources\views/pedidos/index.blade.php ENDPATH**/ ?>