<?php

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

