@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrito de compras</h2>
    <div id="carritoProductos"></div>
    <button onclick="vaciarCarrito()" class="btn btn-outline-dark mt-3">Vaciar carrito</button>
</div>

<script>
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    function mostrarCarrito() {
        let html = '';
        let total = 0;
        if (carrito.length === 0) {
            html = '<p>El carrito está vacío.</p>';
        } else {
            html = '<ul style="list-style:none; padding:0;">';
            carrito.forEach(prod => {
                let subtotal = prod.precio * prod.cantidad;
                total += subtotal;
                html += `<li style="margin-bottom:10px; display:flex; align-items:center;">
                    <img src="/storage/${prod.imagen}" style="width:38px; height:38px; border-radius:6px; margin-right:10px;">
                    <span style="flex:1;">${prod.nombre} x${prod.cantidad}</span>
                    <span>$${subtotal}</span>
                </li>`;
            });
            html += '</ul>';
            html += `<hr><div style="text-align:right; font-weight:bold; color:#15401b;">Total: $${total}</div>`;
        }
        document.getElementById('carritoProductos').innerHTML = html;
    }

    function vaciarCarrito() {
        carrito = [];
        localStorage.setItem('carrito', JSON.stringify(carrito));
        mostrarCarrito();
    }

    document.addEventListener('DOMContentLoaded', mostrarCarrito);
</script>
@endsection