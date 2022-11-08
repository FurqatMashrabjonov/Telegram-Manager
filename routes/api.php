<?php

use App\Http\Controllers\BotController;
use App\Telegram\Handle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::any('/webhook', function (Request $request) {
    \Illuminate\Support\Facades\Log::debug(json_encode($request->all()));
});


//Main Route
Route::any('webhook/{token}', Handle::class);

Route::post('/photo', function (Request $request){
    \Illuminate\Support\Facades\Log::debug(json_encode($request->file('image')));
    return response()->json($request->file('image'));
});
