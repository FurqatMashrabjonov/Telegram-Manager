<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'index')->name('index');
Route::post('/', 'store')->name('store');
Route::delete('/{category}', 'destroy')->name('destroy');
//Route::post('/{category}', 'destroy')->name('destroy');
