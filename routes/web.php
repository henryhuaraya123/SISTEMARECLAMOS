<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificacionController;
use \App\Models\Verificacion;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        $verificaciones = Verificacion::orderBy('id', 'DESC')->paginate(10);
        $filtro = 'none';
        return view('verificaciones', compact('verificaciones','filtro'));;
    })->name('dashboard');

    Route::get('/verificaciones', [VerificacionController::class, 'index'])->name('verificaciones');

    //opciones disponibles para cada procedimiento
    Route::get('/eliminar/{id}', [VerificacionController::class, 'eliminar'])->name('eliminar');
    Route::get('/editar/{id}', [VerificacionController::class, 'editar'])->name('editar');
    Route::get('/verinforme/{id}', [VerificacionController::class, 'verinforme'])->name('verinforme');
    Route::get('/generardocumento/{id}', [VerificacionController::class, 'generardocumento'])->name('generardocumento');
    Route::get('/buscar', [VerificacionController::class, 'buscar'])->name('buscar');

    Route::get('/recibos', function () {
        return view('recibos');
    })->name('recibos');

    Route::get('/actas', function () {
        return view('actas');
    })->name('actas');


    Route::post('/verificacion-store', [VerificacionController::class, 'store'])->name('crear-verificacion');
    Route::post('/informe-store/{id}', [InformeController::class, 'store'])->name('crear-informe');

});
