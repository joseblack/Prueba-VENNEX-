<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\ClienteController;
use App\Models\Role;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\ArticleGeneratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users.index')
    ->middleware('auth', 'verified');
Route::post('/users', [UserController::class, 'store'])->name('users.store')
    ->middleware('auth', 'verified');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')
    ->middleware('auth', 'verified');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')
    ->middleware('auth', 'verified');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')
    ->middleware('auth', 'verified');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')
    ->middleware('auth', 'verified');

Route::get('/asesores', [AsesorController::class, 'index'])->name('asesores.index')
    ->middleware('auth', 'verified');
Route::post('/asesores', [AsesorController::class, 'store'])->name('asesores.store')
    ->middleware('auth', 'verified');
Route::get('/solicitudes', [AsesorController::class, 'solicitudes'])->name('solicitudes.index')
    ->middleware('auth', 'verified');
Route::get('/solicitudes/{solicitud}/edit', [AsesorController::class, 'edit'])->name('solicitudes.edit')
    ->middleware('auth', 'verified');
Route::put('/solicitudes/{solicitud}', [AsesorController::class, 'update'])->name('solicitudes.update')
    ->middleware('auth', 'verified');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index')
    ->middleware('auth', 'verified');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store')
    ->middleware('auth', 'verified');
Route::get('/creditos', [ClienteController::class, 'showCredits'])->name('clientes.showCredits')
    ->middleware('auth', 'verified');
Route::get('/creditos-aprobados', [ClienteController::class, 'showCreditsApproved'])
    ->name('creditos-aprobados.showCreditsApproved')->middleware('auth', 'verified');
Route::get('/creditos/{credito}', [ClienteController::class, 'show'])->name('creditos.show')
    ->middleware('auth', 'verified');
Route::delete('/creditos/{credito}', [ClienteController::class, 'destroy'])->name('creditos.destroy')
    ->middleware('auth', 'verified');

Route::get('/pendientes', [GerenteController::class, 'index'])->name('pendientes.index')
    ->middleware('auth', 'verified');
Route::get('/pendientes/{pendiente}/edit', [GerenteController::class, 'edit'])->name('pendientes.edit')
    ->middleware('auth', 'verified');
Route::put('/pendientes/{pendiente}', [GerenteController::class, 'update'])->name('pendientes.update')
    ->middleware('auth', 'verified');


Route::get('/write', function () {

    $title = '';
    $content = '';
    return view('writer', compact('title', 'content'));
});

Route::post('/write/generate', [ArticleGeneratorController::class, 'submit'])->name('writegenerate.index');
