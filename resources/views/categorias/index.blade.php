@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Lista de Categorías</h1>

@if(session('success') || session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#15401b'
                    });
                @endif
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#c28e00'
                    });
                @endif
            });
        </script>
    @endif

   @auth
       
    <a href="{{ route('categorias.create') }}" class="btn btn-outline-dark mb-3">Agregar Nueva Categoría</a>
    @endauth

    @if($categorias->isEmpty())
        <p>No hay categorías registradas.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                       @auth
                           
                        <td>
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit-alt bx-flashing' ></i></a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')"><i class='bx bxs-trash' ></i></button>
                            </form>
                        </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection