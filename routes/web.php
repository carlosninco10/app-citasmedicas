<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\DisponibilidadesController;
use App\Http\Controllers\EspecialistasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;



// Autenticación
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Página de inicio
Route::get('/home', [HomeController::class, 'index'])->name('panel');

// Mostrar formulario de registro
Route::get('/register', [RegisterController::class, 'create'])->name('register');

// Procesar formulario de registro (POST)
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Rutas con recursos
Route::resources([
    'usuarios' =>  UserController::class,
    'especialistas' =>  EspecialistasController::class,
    'medicos' => MedicosController::class,
    'disponibilidades' => DisponibilidadesController::class,
    'citas' => CitasController::class
]);

Route::get('/401', function () {
    return view('pages/401');
});
Route::get('/404', function () {
    return view('pages/404');
});
Route::get('/500', function () {
    return view('pages/500');
});
