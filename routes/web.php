<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Auth\RegisterController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/carrito', function () {
    return view('carrito.index');
})->name('carrito.index');

// Rutas de pedidos
Route::post('/pedidos', [PedidoController::class, 'store']);
Route::get('/pedidos', [PedidoController::class, 'index'])->middleware('auth');
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->middleware('auth');
Route::post('/pedidos/{id}/completar', [PedidoController::class, 'completar'])->middleware('auth')->name('pedidos.completar');
Route::get('/pedidos/historial', [PedidoController::class, 'historial'])->middleware('auth')->name('pedidos.historial');
Route::get('/pedidos/pendientes', [PedidoController::class, 'pendientes'])->middleware('auth')->name('pedidos.pendientes');

// Registro solo para administradores autenticados
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware('auth')
    ->name('register');

Route::post('register', [RegisterController::class, 'register'])
    ->middleware('auth');
