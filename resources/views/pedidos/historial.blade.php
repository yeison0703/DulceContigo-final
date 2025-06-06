@extends('layouts.app')
 
@section('content')
@if(isset($historialPedidos) && count($historialPedidos) > 0)
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold" style="color:#15401b; margin-bottom:0;">
                Historial de Pedidos
            </h4>
            <span class="badge" style="background:#c28e00; color:white; font-size:1rem; min-width:90px; text-align:right;">
                Total pedidos: {{ count($historialPedidos) }}
            </span>
        </div>
        <div class="table-responsive">
            <table id="historial-pedidos-table" class="table table-bordered" style="background: #fff; border-radius: 16px; box-shadow: 0 4px 16px rgba(21, 64, 27, 0.10); overflow: hidden; font-size: 1rem;">
                <thead>
                    <tr>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">#</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Nombre</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Teléfono</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Método de pago</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Comentarios</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Productos</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Total</th>
                        <th style="background: #15401b; color: #fff; text-align: center; font-weight: 700; border-bottom: 2px solid #c28e00; vertical-align: middle;">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contadorPorDia = [];
                    @endphp
                    @foreach($historialPedidos as $pedido)
                        @php
                            $total = 0;
                            $productos = json_decode($pedido->productos, true);
                            foreach($productos as $producto) {
                                $total += $producto['precio'] * $producto['cantidad'];
                            }
                            $fechaClave = $pedido->created_at->format('Ymd');
                            if (!isset($contadorPorDia[$fechaClave])) {
                                $contadorPorDia[$fechaClave] = 1;
                            } else {
                                $contadorPorDia[$fechaClave]++;
                            }
                            $numeroPedido = $pedido->created_at->format('ymd') . '-' . str_pad($contadorPorDia[$fechaClave], 3, '0', STR_PAD_LEFT);
                        @endphp
                        <tr style="vertical-align: middle; text-align: center; color: #222; background: #f9f9f9;">
                            <td class="fw-bold" style="color:#15401b;">{{ $numeroPedido }}</td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

<style>
    #historial-pedidos-table th {
        background: #c28e00; /* Cambiado a dorado */
        color: #15401b;      /* Texto verde oscuro */
        text-align: center;
        font-weight: 700;
        border-bottom: 2px solid #15401b;
        vertical-align: middle;
    }
    #historial-pedidos-table td {
        vertical-align: middle;
        text-align: center;
        color: #15401b;      /* Texto verde oscuro */
        background: #fffbe6; /* Fondo amarillo claro */
    }
    #historial-pedidos-table tbody tr:hover {
        background: #fff3cd; /* Amarillo más claro al pasar el mouse */
        transition: background 0.2s;
    }
</style>
@endsection