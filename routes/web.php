<?php

use App\Http\Controllers\TipoActividadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('tipos-actividades')
    ->name('tipos-actividades.')
    ->controller(TipoActividadController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('{tipoActividad}', 'update')->name('update');
        Route::delete('{tipoActividad}', 'destroy')->name('destroy');
    });
