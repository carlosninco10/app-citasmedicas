<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('auth/register');
});
Route::get('/menu', function () {
    return view('template');
});
Route::view('/panel', 'panel.index')->name('panel');
Route::resource('usuarios',  UsuariosController::class);



Route::get('/401', function () {
    return view('pages/401');
});
Route::get('/404', function () {
    return view('pages/404');
});
Route::get('/500', function () {
    return view('pages/500');
});
