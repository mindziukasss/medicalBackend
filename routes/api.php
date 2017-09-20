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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/all/posts','MAPostsController@allPosts');
Route::get('/one/post/{id}', 'MAPostsController@showPost');



Route::post('/users/signin', 'MAUsersController@signin');
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/users/logged-in', 'MAUsersController@isLoggedIn');
    Route::resource('/users', 'MAUsersController');
    Route::resource('/posts', 'MAPostsController');
    Route::resource('/roles', 'MARolesController');
});

