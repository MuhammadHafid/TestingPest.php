
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiresource('article', 'ArticleController');

Route::resources([
    'categories' => 'CategoryController',
    'posts' => 'PostController',
]);




//CRUD Categories
//Route::get('/categories', 'ArticleController@categories');
//Route::post('/categories/add', 'ArticleController@addcategories');
//Route::get('/categories/delete/{id}', 'ArticleController@deletecategories');
//Route::post('/categories/update/{id}', 'ArticleController@updatecategories');


//CRUD Users
//Route::get('/Users', 'UsersController@users');
//Route::post('/Users/add', 'UsersController@addusers');
//Route::get('/Users/delete/{id}', 'UsersController@deleteusers');
//Route::post('/Users/update/{id}', 'Users@updatecategories');

