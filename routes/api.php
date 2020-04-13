<?php

use Illuminate\Http\Request;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::post('products', 'ProductController@store');
Route::get('products', 'ProductController@index');
Route::get('products/{product}', 'ProductController@show');

Route::post('categories', 'CategoryController@store');
Route::get('categories', 'CategoryController@index');
Route::get('categories/{category}', 'CategoryController@show');

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});
