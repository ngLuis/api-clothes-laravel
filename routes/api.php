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

// Route::middleware('auth:api')->get('/hello', function (Request $request) {
//     return 'Hello';
// });

Route::group(['middleware' => ['cors']], function() {
    Route::resource('product','ProductController');
    Route::resource('size','SizeController');
    Route::resource('type','TypeController');
    Route::post('file-upload', 'FileController@store');
    Route::post('login', 'UserController@authenticate');
    Route::post('register', 'UserController@register');
});