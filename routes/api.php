<?php

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

#auth
Route::post('auth/login', 'AuthController@login');

#messages
Route::middleware(['check.token', 'auth:api'])->group(function () {
    Route::post('messages', 'MessageController@store');
    Route::get('messages', 'MessageController@index');
});