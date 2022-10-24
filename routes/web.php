<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\CASAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/', [HomeController::class, 'index'])->name('home');//->withoutMiddleware([CASAuth::class]);
Route::get('/logout', function()
{    
    Auth::logout();
    phpCAS::logoutWithRedirectService(route('home')); 
})->name('logout');

