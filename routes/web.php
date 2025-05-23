<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;
use App\Http\Controllers\PerfilController;

Route::get('/', function () {
   $categorias = Categoria::all();
   return view('welcome', compact('categorias'));
});

Route::resource('productos', ProductoController::class);
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::get('/producto/{id}/editar', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');

Route::resource('categorias', CategoriaController::class);
Route::get('/categorias/{id}/productos',[CategoriaController::class, 'verProductos'])->name('categorias.producto');


Route::resource('perfiles', PerfilController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/carrito', function () {
    return view('carrito.index');
})->name('carrito.index');
