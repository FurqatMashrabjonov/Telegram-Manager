<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'index')->name('index');
Route::post('/', 'store')->name('store');
Route::get('/create', 'create')->name('create');
Route::put('/{product}', 'update')->name('update');
Route::delete('/{product}', 'destroy')->name('delete');
