@extends('layouts.app')
@section('content')
<style>
    .producto-detalle-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px 0 rgba(21, 64, 27, 0.12);
        border: none;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 800px;
        margin: 32px auto 0 auto;
    }
    .producto-detalle-img {
        width: 100%;
        max-width: 320px;
        height: 320px;
        object-fit: cover;
        border-radius: 16px;
        border: 2px solid #c28e00;
        box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10);
        background: #f6f6f6;
        margin: 0 auto 18px auto;
        display: block;
    }
    .producto-detalle-nombre {
        color: #15401b;
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 18px;
        letter-spacing: 0.03em;
    }
    .producto-detalle-precio {
        color: #c28e00;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .producto-detalle-info {
        font-size: 1.08rem;
        color: #333;
        margin-bottom: 8px;
    }
    .producto-detalle-descripcion {
        font-size: 1.05rem;
        color: #444;
        margin-bottom: 18px;
    }
    .producto-detalle-btns {
        display: flex;
        gap: 12px;
        margin-top: 18px;
        flex-wrap: wrap;
    }
    .producto-detalle-btns .btn {
        min-width: 120px;
        font-weight: 600;
        border-radius: 8px;
        transition: background 0.2s, color 0.2s;
    }
    .producto-detalle-btns .btn-light {
        border: 1px solid #15401b;
        color: #15401b;
    }
    .producto-detalle-btns .btn-light:hover {
        background: #15401b;
        color: #fff;
    }
    .producto-detalle-btns .btn-secondary {
        background: #c28e00;
        color: #15401b;
        border: none;
    }
    .producto-detalle-btns .btn-secondary:hover {
        background: #15401b;
        color: #fff;
    }
    @media (max-width: 768px) {
        .producto-detalle-card {
            padding: 1.2rem 0.5rem;
        }
        .producto-detalle-img {
            max-width: 100%;
            height: 220px;
        }
    }
</style>
<div class="producto-detalle-card">
    <div class="row align-items-center">
        <div class="col-md-5 text-center">
            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="producto-detalle-img">
        </div>
        <div class="col-md-7">
            <div class="producto-detalle-nombre">{{ $producto->nombre }}</div>
            <div class="producto-detalle-precio">Precio: ${{ $producto->precio }}</div>
            <div class="producto-detalle-info"><strong>Stock disponible:</strong> {{ $producto->stock }}</div>
            <div class="producto-detalle-info"><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</div>
            <div class="producto-detalle-descripcion">{{ $producto->descripcion }}</div>
            <div class="producto-detalle-btns">
                <a href="{{ url()->previous() }}" class="btn btn-light">Volver</a>
                <button type="button" class="btn btn-secondary">Comprar</button>
            </div>
        </div>
    </div>
</div>
@endsection