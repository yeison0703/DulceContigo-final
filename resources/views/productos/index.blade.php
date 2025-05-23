@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Lista de Productos</h1>
    @auth
        <a href="{{ route('productos.create') }}" class="btn btn-outline-dark mb-3">Agregar Nuevo Producto</a>
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
    /* Tabla acorde al diseño */
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
    /* Botones de acción */
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
    /* Botones de exportar */
    .btn-excel i {
        color: #1D6F42;
        font-size: 20px;
    }
    .btn-pdf i {
        color: #D32F2F;
        font-size: 20px;
    }
    /* Responsive */
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
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit-alt'></i></a>
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
});
</script>
</div>
@endsection