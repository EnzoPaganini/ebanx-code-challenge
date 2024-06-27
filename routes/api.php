<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

Route::group([
    'middleware' => ['middleware' => 'api'],
], function () {
    Route::get('/balance/{account_id}', [AccountController::class, 'getBalance']);
    Route::post('/account/create', [AccountController::class, 'createAccount']);
    Route::post('/event', [AccountController::class, 'createEvent']);
});
