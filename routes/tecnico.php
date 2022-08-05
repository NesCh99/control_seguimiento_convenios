<?php

use App\Http\Controllers\Tecnico\ConvenioController;
use App\Http\Controllers\Tecnico\HomeController;
use App\Http\Controllers\Tecnico\CoordinadorController;
use App\Http\Controllers\Tecnico\ResolucionController;
use App\Http\Controllers\Tecnico\ReporteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Aqui se registran las rutas del administrador
|
*/

Route::get('', [HomeController::class, 'index'])->name('tecnico.home');
Route::resource('coordinadores', CoordinadorController::class)->names('tecnico.coordinadores');
Route::resource('convenios', ConvenioController::class)->names('tecnico.convenios');
Route::put('convenios/{idConvenio}/asignarCoordinador/{idCoordinador}', [ConvenioController::class, 'asignarCoordinador'])->name('tecnico.convenios.asignarCoordinador');
Route::put('convenios/{idConvenio}/quitarCoordinador/{idCoordinador}', [ConvenioController::class, 'quitarCoordinador'])->name('tecnico.convenios.quitarCoordinador');
Route::put('convenios/{idConvenio}/asignarResolucion/{idResolucion}', [ConvenioController::class, 'asignarResolucion'])->name('tecnico.convenios.asignarResolucion');
Route::put('convenios/{idConvenio}/quitarResolucion/{idResolucion}', [ConvenioController::class, 'quitarResolucion'])->name('tecnico.convenios.quitarResolucion');
Route::put('convenios/{idConvenio}/asignarInforme/{idInforme}', [ConvenioController::class, 'asignarInforme'])->name('tecnico.convenios.asignarInforme');
Route::put('convenios/{idConvenio}/quitarInforme/{idInforme}', [ConvenioController::class, 'quitarInforme'])->name('tecnico.convenios.quitarInforme');
Route::put('resoluciones/{id}/asignarCoordinador', [ResolucionController::class, 'asignarCoordinador'])->name('tecnico.resoluciones.asignarCoordinador');
Route::put('resoluciones/{idResolucion}/quitarCoordinador/{idCoordinador}', [ResolucionController::class, 'quitarCoordinador'])->name('tecnico.resoluciones.quitarCoordinador');
Route::resource('resoluciones', ResolucionController::class)->names('tecnico.resoluciones');

Route::get('/reportes', [ReporteController::class, 'index'])->name('tecnico.reporte');
Route::post('/reportes', [ReporteController::class, 'index'])->name('tecnico.reporte');