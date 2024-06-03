<?php
use App\Http\Controllers\api\ProductoTallaControllerApi;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::resource('/usuarios', App\Http\Controllers\api\UsuariosControllerApi::class);
Route::get('/usuarios-pas-a-pas', function () {
    return view('usuarios.api.index');
})->name('usuarios.api.index');

Route::resource('/pedidos-compra', App\Http\Controllers\api\PedidoCompraControllerApi::class);
Route::get('/pedidoscompra', function () {
    return view('pedidoscompra.api.index');
})->name('pedidoscompra.api.index');

Route::resource('/productos-api', App\Http\Controllers\api\ProductoControllerApi::class);
Route::resource('/tallas', App\Http\Controllers\api\TallaControllerApi::class);
Route::resource('/producto-talla', App\Http\Controllers\api\ProductoTallaControllerApi::class);
Route::get('/productotalla', function () {
    return view('producto_talla.api.index');
})->name('producto_talla.api.index');



// Rutas protegidas con autenticación Sanctum
/*Route::middleware(['auth:sanctum'])->group(function () {
    // Ruta para obtener información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rutas protegidas para la API
    Route::resource('/usuarios', App\Http\Controllers\api\UsuariosControllerApi::class);
    
    // Otras rutas protegidas...
});*/