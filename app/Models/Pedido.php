<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    protected $fillable = [
        'nombre', 'telefono', 'metodo_pago', 'comentarios', 'productos'
    ];

    public function index()
    {
        $hoy = Carbon::today();
        $manana = Carbon::tomorrow();

        // Pedidos solo del día actual
        $pedidos = \App\Models\Pedido::whereBetween('created_at', [$hoy, $manana])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPedidosHoy = $pedidos->count();

        return view('pedidos.index', compact('pedidos', 'totalPedidosHoy'));
    }
}
