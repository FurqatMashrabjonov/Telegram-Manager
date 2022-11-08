<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelegramUserController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('about', function () {
        return Inertia::render('About');
    })->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::controller(CategoryController::class)
        ->prefix('categories')->as('categories.')
        ->group(__DIR__ . '/categories/index.php');

    Route::controller(BotController::class)
        ->prefix('bot')->as('bot.')
        ->group(__DIR__ . '/bot/index.php');

    Route::controller(ProductController::class)
        ->prefix('products')->as('products.')
        ->group(__DIR__ . '/products/index.php');

    Route::controller(TelegramUserController::class)
        ->prefix('users')->as('telegram_users.')
        ->group(__DIR__ . '/telegram_users/index.php');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');


});


Route::get('img', function () {
    $res = Http::get('https://api.telegram.org/bot2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM/sendPhoto', [
        'chat_id' => '778912691',
        'photo' => 'https://720d-213-230-72-63.eu.ngrok.io/product_images/101/49/tiNGKr25iO.jpg'
    ]);
    echo $res->body();
});
