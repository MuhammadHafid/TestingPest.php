
<?php

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

Route::group(['namespace' => 'API\V1'], function () {
     Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('articles', 'ArticleController');
        Route::apiResource('comments', 'CommentController');

        Route::post('me', 'AuthController@me')->name('auth.me');

        Route::post('logout', 'AuthController@logout')->name('auth.logout');
     });
    Route::apiResource('users', 'UserController');
    Route::apiResource('categories', 'CategoryController');
    Route::post('login', 'AuthController@login')->name('auth.login');

});
