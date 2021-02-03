<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\PostsController;

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


Route::post('/create_user', 'UsersController@create');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('login','Auth\LoginController@logout');



/**
 * защищщенный доступ к основыным действиям
 */
Route::middleware('/auth:api')->group(function () {

    /**
     * User Routes
     */
    Route::put('/edit_user/{id}', 'UsersController@edit');
    Route::get('/show_user', 'UsersController@show');
    Route::get('/profile_user', 'UsersController@showMe');
    Route::delete('/delete_user/{id}', 'UsersController@destroy');

    /**
     * Followers Routes
     */
    Route::post('/add_follower/{id}', 'FollowersController@create');
    Route::get('/show_follower', 'FollowersController@show');
    Route::delete('/delete_follower/{id}', 'FollowersController@destroy');

    /**
     * Posts Routes
     */
    Route::post('create_post', 'PostsController@create');
    Route::put('/edit_post/{id}', 'PostsController@edit');
    Route::get('show_post/{id}', 'PostsController@show');
    Route::delete('/delete_post/{id}', 'PostsController@destroy');

    /**
     * Comments Routes
     */
    Route::post('/create_comment', 'CommentsController@create');
    Route::put('/edit_comment/{id}', 'CommentsController@edit');
    Route::get('/show_comment/{id}', 'CommentsController@show');
    Route::delete('/delete_comment/{id}', 'CommentsController@destroy');

    /**
     * BLM Routes
     */
    Route::post('/add_BLM/{id}', 'BlackListsController@create');
    Route::get('/show_BLM', 'BlackListsController@show');
    Route::delete('/delete_BLM/{id}', 'BlackListsController@destroy');
});
