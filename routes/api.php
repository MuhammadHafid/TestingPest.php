
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::group(['namespace' => 'API\V1'], function () {
    Route::apiResource('users', 'UserController');
    Route::apiResource('categories', 'CategoryController');
    Route::post('login', 'AuthController@login')->name('auth.login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('me', 'AuthController@me')->name('auth.me');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
    });
});
