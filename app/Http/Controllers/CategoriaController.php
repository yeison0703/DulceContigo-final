<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['verProductos']);
    }
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria = Categoria::findOrFail($categoria->id);
        if ($categoria->productos()->count() > 0) {
            return redirect()->route('categorias.index')->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }//evita eliminar una categoria que tiene productos asociados

        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');//elimina la categoria
    }

    public function verProductos($id)
    {
        $categoria = Categoria::findOrFail($id);
        $productos = $categoria->productos; 
        return view('categorias.productos', compact('categoria', 'productos'));
    }
    
}