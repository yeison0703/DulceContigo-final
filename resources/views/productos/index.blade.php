@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Lista de Productos</h1>
    @auth
        <a href="{{ route('productos.create') }}" class="btn btn-outline-dark mb-3" style="font-weight:600; border-radius: 1.5rem;"><i class="fa fa-plus"></i> Agregar Nuevo Producto</a>
    @endauth

@if(session('success') || session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false,
                });
            @endif
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ session('error') }}',
                    timer: 2000,
                    showConfirmButton: false,
                });
            @endif
        });
    </script>
@endif

@if ($productos->isEmpty())
    <p>No hay productos registrados.</p>
@else

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
            @auth
            <th>Acciones</th>
            @endauth 
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>${{ $producto->precio }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->categoria->nombre ?? 'sin categoria' }}</td>
            <td>
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" width="80" alt="imagen del producto">
                @else
                    Sin imagen
                @endif
            </td>
            <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
            @auth
            <td>
                <!-- Botón para abrir el modal de edición -->
                <button 
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editarProductoModal"
                    data-id="{{ $producto->id }}"
                    data-nombre="{{ $producto->nombre }}"
                    data-descripcion="{{ $producto->descripcion }}"
                    data-precio="{{ $producto->precio }}"
                    data-stock="{{ $producto->stock }}"
                    data-categoria="{{ $producto->categoria_id }}"
                    data-imagen="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '' }}"
                    title="Editar"
                >
                    <i class='bx bxs-edit-alt'></i>
                </button>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')"><i class='bx bxs-trash'></i></button>
                </form>
            </td>
            @endauth
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<!-- Modal de edición de producto -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditarProducto" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
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
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                @endforeach
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
@endsection