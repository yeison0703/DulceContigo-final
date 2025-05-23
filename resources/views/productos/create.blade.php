@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agregar Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-1">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-1">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-1">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ old('precio') }}" required>
        </div>

        <div class="mb-1">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
        </div>

        <div class="mb-1">
            <label for="categoria_id" class="form-label">Categoría:</label>
            <select class="form-select" name="categoria_id" id="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-1">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control" value="{{ old('imagen') }}" accept="image/*">
        </div>

        <button type="submit" class="btn btn-outline-dark">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
