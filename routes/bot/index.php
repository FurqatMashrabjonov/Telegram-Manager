<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'index')->name('index');
Route::put('/', 'update')->name('update');

Route::post('/set_webhook', 'setWebhook')->name('set_webhook');
Route::post('/delete_webhook', 'deleteWebhook')->name('delete_webhook');
