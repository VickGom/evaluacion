<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|    Aqui se crean las rutas en php para la navegacion del usuario.
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('/articulo', function () {
    return view('articulo');
});

Route::get('/agregar-articulo', function () {
    return view('agregar');
});

Route::get('/buscar/{sku}', [ArticuloController::class, 'buscarSku']);

Route::get('/mostrar/{sku}', [ArticuloController::class, 'mostrarArticulo']);

Route::get('/mostrar-clase/{departamento}', [ArticuloController::class, 'obtenerClase']);

Route::get('/mostrar-familia/{clase}', [ArticuloController::class, 'obtenerFamilia']);

Route::put('/modificar', [ArticuloController::class, 'modificar']);

Route::get('/mostrar-departamento', [ArticuloController::class, 'obtenerDepartamento']);

Route::post('/agregar', [ArticuloController::class, 'agregar']);

Route::delete('/eliminar/{sku}', [ArticuloController::class, 'eliminar']);

