<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ClasificacionController;
use App\Http\Controllers\Admin\CoordinadorController;
use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\EjeController;
use App\Models\Coordinador;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Aqui se registran las rutas del administrador
|
*/

Route::get('', [HomeController::class, 'index'])->name('admin.home');
Route::resource('clasificaciones', ClasificacionController::class)->names('admin.clasificaciones');
Route::resource('ejes', EjeController::class)->names('admin.ejes');
Route::resource('dependencias', DependenciaController::class)->names('admin.dependencias');

