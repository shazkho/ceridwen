<?php

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

// Rutas de autenticación
Auth::routes();

// Ruta al home (será eliminado)
Route::get('/home', 'HomeController@index')->name('home');

// CRUD para los 'formatos'.
Route::resource('formatos', 'FormatoController');
Route::resource('facultades', 'FormatoController');
