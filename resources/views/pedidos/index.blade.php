@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color:#15401b;">Pedidos</h2>
        <span class="badge" style="background-color:#c28e00; color:#fff; font-size:1.1rem; padding:10px 18px;">
            Pedidos hoy: {{ $totalPedidosHoy ?? 0 }}
        </span>
    </div>
    @if($pedidos->isEmpty())
        <div class="alert alert-info text-center">
            No hay pedidos registrados.
        </div>
    @else
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
                @foreach($pedidos as $pedido)
                @php
                    $total = 0;
                    $productos = json_decode($pedido->productos, true);
                    foreach($productos as $producto) {
                        $total += $producto['precio'] * $producto['cantidad'];
                    }
                @endphp
                <tr id="pedido-{{ $pedido->id }}">
                    <td class="fw-bold" style="color:#15401b;">{{ $pedido->id }}</td>
                    <td>{{ $pedido->nombre }}</td>
                    <td>{{ $pedido->telefono }}</td>
                    <td>
                        <span class="badge" style="background:#15401b; color:#fff;">{{ $pedido->metodo_pago }}</span>
                    </td>
                    <td>{{ $pedido->comentarios }}</td>
                    <td>
                        <ul class="mb-0 ps-3" style="font-size: 0.97rem;">
                            @foreach($productos as $producto)
                                <li>
                                    <span class="fw-semibold" style="color:#15401b;">{{ $producto['nombre'] }}</span>
                                    x{{ $producto['cantidad'] }}
                                    <span class="text-muted">(${{ number_format($producto['precio'], 2) }} c/u)</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="fw-bold text-success" style="font-size:1.15rem;">
                        ${{ number_format($total, 2) }}
                    </td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn-confirmar-pedido" data-id="{{ $pedido->id }}">
                            <i class="fa fa-check"></i> Listo
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
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
@endsection