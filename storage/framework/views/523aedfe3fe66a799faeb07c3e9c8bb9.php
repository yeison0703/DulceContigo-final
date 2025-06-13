<?php $__env->startSection('content'); ?>
    <?php if(isset($historialPedidos) && count($historialPedidos) > 0): ?>
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold" style="color:#15401b; margin-bottom:0;">
                    Historial de Pedidos.
                </h4>
                <span class="badge"
                    style="background:#c28e00; color:white; font-size:1rem; min-width:90px; text-align:right;">
                    Total pedidos: <?php echo e(count($historialPedidos)); ?>

                </span>
            </div>
            <div class="table-responsive">
                <table id="historial-pedidos-table" class="table table-bordered"
                    style="background: #fff; border-radius: 16px; box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10); overflow: hidden; font-size: 1rem;">
                    <thead>
                        <tr>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                #</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Nombre</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Teléfono</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Método de pago</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Comentarios</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Productos</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Total</th>
                            <th
                                style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">
                                Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $contadorPorDia = [];
                        ?>
                        <?php $__currentLoopData = $historialPedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $total = 0;
                                $productos = json_decode($pedido->productos, true);
                                foreach ($productos as $producto) {
                                    $total += $producto['precio'] * $producto['cantidad'];
                                }
                                $fechaClave = $pedido->created_at->format('Ymd');
                                if (!isset($contadorPorDia[$fechaClave])) {
                                    $contadorPorDia[$fechaClave] = 1;
                                } else {
                                    $contadorPorDia[$fechaClave]++;
                                }
                                $numeroPedido =
                                    $pedido->created_at->format('ymd') .
                                    '-' .
                                    str_pad($contadorPorDia[$fechaClave], 3, '0', STR_PAD_LEFT);
                            ?>
                            <tr style="vertical-align: middle; text-align: center; color: #222; background: #f9f9f9;">
                                <td class="fw-bold" style="color:#15401b;"><?php echo e($numeroPedido); ?></td>
                                <td><?php echo e($pedido->nombre); ?></td>
                                <td><?php echo e($pedido->telefono); ?></td>
                                <td>
                                    <span class="badge"
                                        style="background:#15401b; color:#fff;"><?php echo e($pedido->metodo_pago); ?></span>
                                </td>
                                <td><?php echo e($pedido->comentarios); ?></td>
                                <td>
                                    <ul class="mb-0 ps-3" style="font-size: 0.97rem;">
                                        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <span class="fw-semibold"
                                                    style="color:#15401b;"><?php echo e($producto['nombre']); ?></span>
                                                x<?php echo e($producto['cantidad']); ?>

                                                <span class="text-muted">($<?php echo e(number_format($producto['precio'], 2)); ?>

                                                    c/u)</span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </td>
                                <td class="fw-bold text-success" style="font-size:1.15rem;">
                                    $<?php echo e(number_format($total, 2)); ?>

                                </td>
                                <td><?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $('#historial-pedidos-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn-excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn-pdf',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    }
                ],
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    zeroRecords: "No se encontraron registros coincidentes",
                    emptyTable: "No hay datos disponibles en la tabla"
                }
            });
        });
    </script>
    <style>
        #historial-pedidos-table th {
            background: #c28e00;
            /* Cambiado a dorado */
            color: #15401b;
            /* Texto verde oscuro */
            text-align: center;
            font-weight: 700;
            border-bottom: 2px solid #15401b;
            vertical-align: middle;
        }

        #historial-pedidos-table td {
            vertical-align: middle;
            text-align: center;
            color: #15401b;
            /* Texto verde oscuro */
            background: #fffbe6;
            /* Fondo amarillo claro */
        }

        #historial-pedidos-table tbody tr:hover {
            background: #fff3cd;
            /* Amarillo más claro al pasar el mouse */
            transition: background 0.2s;
        }

        .btn-excel {
            background: #28a745 !important;
            color: #fff !important;
            border: none !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            margin-right: 8px !important;
            padding: 6px 16px !important;
            font-size: 1rem !important;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.08);
            transition: background 0.2s;
        }

        .btn-excel:hover {
            background: #218838 !important;
            color: #fff !important;
        }

        .btn-pdf {
            background: #dc3545 !important;
            color: #fff !important;
            border: none !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            padding: 6px 16px !important;
            font-size: 1rem !important;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.08);
            transition: background 0.2s;
        }

        .btn-pdf:hover {
            background: #b52a37 !important;
            color: #fff !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DulceContigo-final\resources\views/pedidos/historial.blade.php ENDPATH**/ ?>