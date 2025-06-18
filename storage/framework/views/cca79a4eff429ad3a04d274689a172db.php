<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="fw-bold mb-4 text-center" style="color:#15401b;">Lista de Categorías</h2>

    <?php if(session('success') || session('error')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php if(session('success')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '<?php echo e(session('success')); ?>',
                        confirmButtonColor: '#15401b'
                    });
                <?php endif; ?>
                <?php if(session('error')): ?>
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: '<?php echo e(session('error')); ?>',
                        confirmButtonColor: '#c28e00'
                    });
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <a href="#" class="btn btn-outline-dark mb-3" style="font-weight:600; border-radius: 1.5rem;" data-bs-toggle="modal" data-bs-target="#crearCategoriaModal">
    <i class="fa fa-plus"></i> Agregar Nueva Categoría
</a>
    <?php endif; ?>

    <?php if($categorias->isEmpty()): ?>
        <div class="alert alert-info text-center">
            No hay categorías registradas.
        </div>
    <?php else: ?>
    <style>
        #categorias-table {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10);
            overflow: hidden;
            font-size: 1rem;
        }
        #categorias-table th {
            background: #15401b;
            color: #fff;
            text-align: center;
            font-weight: 700;
            border-bottom: 2px solid #c28e00;
            vertical-align: middle;
        }
        #categorias-table td {
            vertical-align: middle;
            text-align: center;
            color: #222;
            background: #f9f9f9;
        }
        #categorias-table tbody tr:hover {
            background: #eefaf3;
            transition: background 0.2s;
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
        #crearCategoriaModal .modal-content {
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(21, 64, 27, 0.12);
            border: 1px solid #e0e0e0;
        }
        #crearCategoriaModal .modal-header {
            background: #15401b;
            color: #fff;
            border-radius: 16px 16px 0 0;
            font-weight: bold;
            text-align: center;
        }
        #crearCategoriaModal .modal-title {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        #crearCategoriaModal .btn-primary {
            background: #15401b;
            border: none;
            font-weight: 600;
            border-radius: 8px;
        }
        #crearCategoriaModal .btn-primary:hover {
            background: #c28e00;
            color: #fff;
        }
        #crearCategoriaModal .btn-secondary {
            border-radius: 8px;
        }
        #crearCategoriaModal .form-label {
            color: #15401b;
            font-weight: 600;
        }
        #crearCategoriaModal .form-control:focus {
            border-color: #15401b;
            box-shadow: none;
        }
        #crearCategoriaModal .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            box-shadow: none;
        }
    </style>
    <div class="table-responsive">
        <table id="categorias-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <?php if(auth()->guard()->check()): ?>
                    <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="fw-semibold" style="color:#15401b;"><?php echo e($categoria->nombre); ?></td>
                    <td><?php echo e($categoria->descripcion); ?></td>
                    <?php if(auth()->guard()->check()): ?>
                    <td>
                        <button 
    class="btn btn-warning btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#editarCategoriaModal"
    data-id="<?php echo e($categoria->id); ?>"
    data-nombre="<?php echo e($categoria->nombre); ?>"
    data-descripcion="<?php echo e($categoria->descripcion); ?>"
    title="Editar"
>
    <i class='bx bxs-edit-alt'></i>
</button>
                        <form action="<?php echo e(route('categorias.destroy', $categoria->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')"><i class='bx bxs-trash'></i></button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<!-- Modal de creación de categoría -->
<div class="modal fade" id="crearCategoriaModal" tabindex="-1" aria-labelledby="crearCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php echo e(route('categorias.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearCategoriaLabel">Agregar Nueva Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="crear-nombre" class="form-label">Nombre de la categoría:</label>
            <input type="text" name="nombre" id="crear-nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="crear-descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="crear-descripcion" class="form-control" rows="3"></textarea>
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

<!-- Modal de edición de categoría -->
<style>
    /* Estilos para la modal de edición */
    #editarCategoriaModal .modal-content {
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(21, 64, 27, 0.12);
        border: 1px solid #e0e0e0;
    }
    #editarCategoriaModal .modal-header {
        background: #15401b;
        color: #fff;
        border-radius: 16px 16px 0 0;
        font-weight: bold;
        text-align: center;
    }
    #editarCategoriaModal .modal-title {
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    #editarCategoriaModal .btn-primary {
        background: #15401b;
        border: none;
        font-weight: 600;
        border-radius: 8px;
    }
    #editarCategoriaModal .btn-primary:hover {
        background: #c28e00;
        color: #fff;
    }
    #editarCategoriaModal .btn-secondary {
        border-radius: 8px;
    }
    #editarCategoriaModal .form-label {
        color: #15401b;
        font-weight: 600;
    }
    #editarCategoriaModal .form-control:focus {
        border-color: #15401b;
        box-shadow: none;
    }
    #editarCategoriaModal .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        box-shadow: none;
    }
</style>
<div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditarCategoria" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarCategoriaLabel">Editar Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="modal-nombre" class="form-label">Nombre de la categoría:</label>
            <input type="text" name="nombre" id="modal-nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="modal-descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="modal-descripcion" class="form-control" rows="3"></textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    var editarModal = document.getElementById('editarCategoriaModal');
    editarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var descripcion = button.getAttribute('data-descripcion');

        document.getElementById('modal-nombre').value = nombre;
        document.getElementById('modal-descripcion').value = descripcion;

        var form = document.getElementById('formEditarCategoria');
        form.action = '/categorias/' + id;
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DulceContigo-final\resources\views/categorias/index.blade.php ENDPATH**/ ?>