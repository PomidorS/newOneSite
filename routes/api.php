<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


/**
 * маршруты аутентификации
 */
Route::get('login',  'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

/**
 * маршруты регистрации
 */
Route::get('register',  'Auth\RegisterController@showRegistrationForm')
    ->name('register');
Route::post('register', 'Auth\RegisterController@register');

/**
 * защищенный доступ к основыным действиям
 */
Route::middleware('/auth:api')->group(function () {

    /**
     * маршруты сброса пароля
     */
    Route::prefix('password')->group(function () {
        Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('password.request');
        Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('password.email');
        Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
            ->name('password.reset');
        Route::post('/reset', 'Auth\ResetPasswordController@reset');
    });

    /**
     * User Routes
     */
    Route::prefix('user')->group(function () {
        Route::put('/{user}', 'UsersController@edit')
            ->where('id', '[0-9]+');
        Route::get('/show', 'UsersController@show');
        Route::get('/profile', 'UsersController@showMe');
        Route::delete('/{user}', 'UsersController@destroy')
            ->where('id', '[0-9]+');
    });

    /**
     * Followers Routes
     */
    Route::prefix('follower')->group(function () {
        Route::post('/{follower}', 'FollowersController@create')
            ->where('id', '[0-9]+');
        Route::get('/show', 'FollowersController@show');
        Route::delete('/{follower}', 'FollowersController@destroy')
            ->where('id', '[0-9]+');
    });

    /**
     * Posts Routes
     */
    Route::prefix('posts')->group(function () {
        Route::post('/create', 'PostsController@create');
        Route::put('/{posts}', 'PostsController@edit')
            ->where('id', '[0-9]+');
        Route::get('/{posts}/{quantity}', 'PostsController@show')
            ->where('id', '[0-9]+');
        Route::delete('/{posts}', 'PostsController@destroy')
            ->where('id', '[0-9]+');
    });

    /**
     * Comments Routes
     */
    Route::prefix('comment')->group(function () {
        Route::post('/create', 'CommentsController@create');
        Route::put('/{comment}', 'CommentsController@edit')
            ->where('id', '[0-9]+');
        Route::get('/{comment}', 'CommentsController@show')
            ->where('id', '[0-9]+');
        Route::delete('/{comment}', 'CommentsController@destroy')
            ->where('id', '[0-9]+');
    });

    /**
     * BL Routes
     */
    Route::prefix('black_lists')->group(function () {
        Route::post('/{blacklist}', 'BlackListsController@create')
            ->where('id', '[0-9]+');
        Route::get('/show', 'BlackListsController@show');
        Route::delete('/{blacklist}', 'BlackListsController@destroy')
            ->where('id', '[0-9]+');
    });
});
