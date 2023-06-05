<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProspectoController;

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

Route::get('/capturar', function () {
    return view('capturar_prospecto');
});


Route::post('/prospectos-agregar', [ProspectoController::class, 'store']);

Route::get('/prospectos-obtener', [ProspectoController::class, 'index']);

Route::get('/informacion/{id}', [ProspectoController::class, 'informacion']);

Route::get('/evaluar/{id}', [ProspectoController::class, 'evaluar']);

Route::get('/informacion/informacion-obtener/{id}', [ProspectoController::class, 'obtenerInformacion']);

Route::get('/download/{filename}', [ProspectoController::class, 'download']);

Route::post('/cambiar-status', [ProspectoController::class, 'cambiarStatus']);

