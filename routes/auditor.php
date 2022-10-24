<?php

use App\Http\Controllers\Auditor\ConvenioController;
use App\Http\Controllers\Auditor\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auditor Routes
|--------------------------------------------------------------------------
|
| Aqui se registran las rutas del auditor
|
*/

Route::get('', [HomeController::class, 'index'])->name('auditor.home');
Route::resource('convenios', ConvenioController::class)->names('auditor.convenios');

