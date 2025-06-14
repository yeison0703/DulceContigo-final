<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
    
     public function index()
    {
    $productos = Producto::with('categoria')->get();
    $categorias = Categoria::all();
    return view('productos.index', compact('productos', 'categorias'));
    }


    public function create()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('productos.create', compact('categorias'));

    }


    public function store(Request $request)
{
    // Validación de los campos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
    ]);

    $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

    // Crear el producto
    Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'categoria_id' => $request->categoria_id,
        'imagen' => $rutaImagen,
    ]);

    // Redirigir al listado
    return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
}

    public function show(string $id)
    {
        $producto = Producto::with('categoria')->findOrFail($id); // Obtener el producto con la relación de categoría
        return view('productos.show', compact('producto'));
 //
    }


    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, string $id)
{
    // Validación de los campos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $producto = Producto::findOrFail($id);

    $data = $request->all();

    // Si se sube una nueva imagen, guárdala y actualiza el campo
    if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('productos', 'public');
        $data['imagen'] = $rutaImagen;
    } else {
        // Si no se sube nueva imagen, no modificar el campo imagen
        unset($data['imagen']);
    }

    $producto->update($data);

    // Redirigir al listado con mensaje
    return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
}


    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        // Redirigir al listado con mensaje
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
   
}
