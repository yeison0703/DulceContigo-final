<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 style="text-align: center">Lista de Productos</h1>
    <?php if(auth()->guard()->check()): ?>
        <a href="#" class="btn btn-outline-dark mb-3" style="font-weight:600; border-radius: 1.5rem;" data-bs-toggle="modal" data-bs-target="#crearProductoModal">
    <i class="fa fa-plus"></i> Agregar Nuevo Producto
</a>
    <?php endif; ?>

<?php if(session('success') || session('error')): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?php echo e(session('success')); ?>',
                    timer: 2000,
                    showConfirmButton: false,
                });
            <?php endif; ?>
            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '<?php echo e(session('error')); ?>',
                    timer: 2000,
                    showConfirmButton: false,
                });
            <?php endif; ?>
        });
    </script>
<?php endif; ?>

<?php if($productos->isEmpty()): ?>
    <p>No hay productos registrados.</p>
<?php else: ?>

<style>
    
    #productos-table {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10);
        overflow: hidden;
        font-size: 1rem;
    }
    #productos-table th {
        background: #15401b;
        color: #fff;
        text-align: center;
        font-weight: 700;
        border-bottom: 2px solid #c28e00;
        vertical-align: middle;
    }
    #productos-table td {
        vertical-align: middle;
        text-align: center;
        color: #222;
        background: #f9f9f9;
    }
    #productos-table tbody tr:hover {
        background: #eefaf3;
        transition: background 0.2s;
    }
    #productos-table img {
        border-radius: 8px;
        border: 2px solid #c28e00;
        background: #f6f6f6;
        max-width: 80px;
        max-height: 80px;
        object-fit: cover;
        margin: 0 auto;
        display: block;
    }
   
    .btn-warning.btn-sm {
        background: #c28e00;
        color: #15401b;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        padding: 4px 10px;
        font-size: 1rem;
    }
    .btn-warning.btn-sm:hover {
        background: #15401b;
        color: #fff;
    }
    .btn-danger.btn-sm {
        background: #15401b;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        padding: 4px 10px;
        font-size: 1rem;
    }
    .btn-danger.btn-sm:hover {
        background: #c28e00;
        color: #15401b;
    }
    /* Estilos para la modal de edición */
    #editarProductoModal .modal-content {
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(21, 64, 27, 0.12);
        border: 1px solid #e0e0e0;
    }
    #editarProductoModal .modal-header {
        background: #15401b;
        color: #fff;
        border-radius: 16px 16px 0 0;
        font-weight: bold;
        text-align: center;
    }
    #editarProductoModal .modal-title {
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    #editarProductoModal .btn-primary {
        background: #15401b;
        border: none;
        font-weight: 600;
        border-radius: 8px;
    }
    #editarProductoModal .btn-primary:hover {
        background: #c28e00;
        color: #fff;
    }
    #editarProductoModal .btn-secondary {
        border-radius: 8px;
    }
    #editarProductoModal .form-label {
        color: #15401b;
        font-weight: 600;
    }
    #editarProductoModal .form-control:focus {
        border-color: #15401b;
        box-shadow: none;
    }
    #editarProductoModal .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        box-shadow: none;
    }
    /* Estilos para la modal de creación */
    #crearProductoModal .modal-content {
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(21, 64, 27, 0.12);
        border: 1px solid #e0e0e0;
    }
    #crearProductoModal .modal-header {
        background: #15401b;
        color: #fff;
        border-radius: 16px 16px 0 0;
        font-weight: bold;
        text-align: center;
    }
    #crearProductoModal .modal-title {
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    #crearProductoModal .btn-primary {
        background: #15401b;
        border: none;
        font-weight: 600;
        border-radius: 8px;
    }
    #crearProductoModal .btn-primary:hover {
        background: #c28e00;
        color: #fff;
    }
    #crearProductoModal .btn-secondary {
        border-radius: 8px;
    }
    #crearProductoModal .form-label {
        color: #15401b;
        font-weight: 600;
    }
    #crearProductoModal .form-control:focus {
        border-color: #15401b;
        box-shadow: none;
    }
    #crearProductoModal .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        box-shadow: none;
    }
    @media (max-width: 768px) {
        #productos-table th, #productos-table td {
            font-size: 0.95rem;
            padding: 6px 4px;
        }
    }
</style>

<table id="productos-table" class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Imagen</th>
            <th>Fecha de creación</th>
            <?php if(auth()->guard()->check()): ?>
            <th>Acciones</th>
            <?php endif; ?> 
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($producto->nombre); ?></td>
            <td><?php echo e($producto->descripcion); ?></td>
            <td>$<?php echo e($producto->precio); ?></td>
            <td><?php echo e($producto->stock); ?></td>
            <td><?php echo e($producto->categoria->nombre ?? 'sin categoria'); ?></td>
            <td>
                <?php if($producto->imagen): ?>
                    <img src="<?php echo e(asset('storage/' . $producto->imagen)); ?>" width="80" alt="imagen del producto">
                <?php else: ?>
                    Sin imagen
                <?php endif; ?>
            </td>
            <td><?php echo e($producto->created_at->format('d/m/Y H:i')); ?></td>
            <?php if(auth()->guard()->check()): ?>
            <td>
                <!-- Botón para abrir el modal de edición -->
                <button 
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editarProductoModal"
                    data-id="<?php echo e($producto->id); ?>"
                    data-nombre="<?php echo e($producto->nombre); ?>"
                    data-descripcion="<?php echo e($producto->descripcion); ?>"
                    data-precio="<?php echo e($producto->precio); ?>"
                    data-stock="<?php echo e($producto->stock); ?>"
                    data-categoria="<?php echo e($producto->categoria_id); ?>"
                    data-imagen="<?php echo e($producto->imagen ? asset('storage/' . $producto->imagen) : ''); ?>"
                    title="Editar"
                >
                    <i class='bx bxs-edit-alt'></i>
                </button>
                <form action="<?php echo e(route('productos.destroy', $producto->id)); ?>" method="POST" style="display:inline-block;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')"><i class='bx bxs-trash'></i></button>
                </form>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>

<!-- Modal de edición de producto -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditarProducto" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarProductoLabel">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="modal-nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="modal-nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="modal-descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="modal-descripcion" class="form-control" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="modal-precio" class="form-label">Precio:</label>
            <input type="number" name="precio" id="modal-precio" class="form-control" min="0" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="modal-stock" class="form-label">Stock:</label>
            <input type="number" name="stock" id="modal-stock" class="form-control" min="0" required>
          </div>
          <div class="mb-3">
            <label for="modal-categoria" class="form-label">Categoría:</label>
            <select name="categoria_id" id="modal-categoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Imagen actual:</label>
            <div id="modal-imagen-preview" class="mb-2"></div>
            <label for="modal-imagen" class="form-label">Cambiar imagen:</label>
            <input type="file" name="imagen" id="modal-imagen" class="form-control" accept="image/*">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal de creación de producto -->
<div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php echo e(route('productos.store')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearProductoLabel">Agregar Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="crear-nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="crear-nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="crear-descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="crear-descripcion" class="form-control" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="crear-precio" class="form-label">Precio:</label>
            <input type="number" name="precio" id="crear-precio" class="form-control" min="0" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="crear-stock" class="form-label">Stock:</label>
            <input type="number" name="stock" id="crear-stock" class="form-control" min="0" required>
          </div>
          <div class="mb-3">
            <label for="crear-categoria" class="form-label">Categoría:</label>
            <select name="categoria_id" id="crear-categoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="crear-imagen" class="form-label">Imagen:</label>
            <input type="file" name="imagen" id="crear-imagen" class="form-control" accept="image/*">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Crear</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#productos-table').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
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

    // Modal edición producto
    var editarModal = document.getElementById('editarProductoModal');
    editarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var descripcion = button.getAttribute('data-descripcion');
        var precio = button.getAttribute('data-precio');
        var stock = button.getAttribute('data-stock');
        var categoria = button.getAttribute('data-categoria');
        var imagen = button.getAttribute('data-imagen');
        var preview = document.getElementById('modal-imagen-preview');

        document.getElementById('modal-nombre').value = nombre;
        document.getElementById('modal-descripcion').value = descripcion;
        document.getElementById('modal-precio').value = precio;
        document.getElementById('modal-stock').value = stock;
        document.getElementById('modal-categoria').value = categoria;

        if(imagen){
            preview.innerHTML = '<img src="'+imagen+'" alt="Imagen actual" style="max-width:100px;max-height:100px;border-radius:8px;border:1px solid #ccc;">';
        } else {
            preview.innerHTML = '<span class="text-muted">Sin imagen</span>';
        }

        var form = document.getElementById('formEditarProducto');
        form.action = '/productos/' + id;
    });
});
</script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Yeison\Pictures\Instagram_files\dulcecontigo-copia-ACTULIZADO 23 DE MAYO\resources\views/productos/index.blade.php ENDPATH**/ ?>