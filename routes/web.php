<?php

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
Route::group(["middleware" => "auth"], function () {
    Route::get('/', function () {
        return view('welcome');
    });


    Route::get('/home', 'HomeController@index')->name('home');
    //-----------------------------------ROUTE PRESTAMOS---------------------------------------------------------
    Route::get("/recurso/busqueda", "RecursoController@buscar")->name("buscar.recurso");
    Route::get("/recursos", "RecursoController@index")->name("recursos.index");
    Route::post("/recurso/nuevo", "RecursoController@store")->name("create.recurso");
    Route::delete("/recurso/eliminar", "RecursoController@destroy")->name("destroy.recurso");
    Route::put("/recurso/editar", "RecursoController@update")->name("update.recurso");
    //---------------------------------ROUTES HISTORIAL DE PRESTAMOS-------------------------------------
    Route::get("/historial/prestamo", "RegistroPrestamoController@index")->name("index.historial");
    Route::get("/historial/busqueda", "RegistroPrestamoController@buscar")->name("buscar.historial");
    Route::post("/historial/crear","RegistroPrestamoController@store")->name("create.historial");
    Route::put("/historial/update","RegistroPrestamoController@update")->name("update.historial");
    Route::delete("/historial/destroy","RegistroPrestamoController@destroy")->name("destroy.historial");


});
Auth::routes();