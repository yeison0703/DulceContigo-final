<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Carbon\Carbon;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:30',
            'metodo_pago' => 'required|string',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array',
        ]);

        Pedido::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'metodo_pago' => $request->metodo_pago,
            'comentarios' => $request->comentarios,
            'productos' => json_encode($request->productos),
        ]);

        return response()->json(['ok' => true]);
    }

    public function index()
    {
        $hoy = Carbon::today();
        $manana = Carbon::tomorrow();

        // Solo pedidos del día actual
        $pedidos = \App\Models\Pedido::whereBetween('created_at', [$hoy, $manana])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPedidosHoy = $pedidos->count();

        return view('pedidos.index', compact('pedidos', 'totalPedidosHoy'));
    }
    public function destroy($id)
    {
        $pedido = \App\Models\Pedido::findOrFail($id);
        $pedido->delete();
        return response()->json(['ok' => true]);
    }
}
