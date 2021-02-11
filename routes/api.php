<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

/**
 * маршруты регистрации
 */
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')
    ->name('/register');
Route::post('/register', 'Auth\RegisterController@register');

/**
 * защищенный доступ к основыным действиям
 */
Route::middleware('auth')->group(function () {

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
            ->where('user', '[0-9]+');
        Route::get('/{user_id}/show', 'UsersController@show')
            ->where('user_id', '[0-9]+');
        Route::get('/profile', 'UsersController@showMe');
        Route::delete('/{user}', 'UsersController@destroy')
            ->where('user', '[0-9]+');
    });

    /**
     * Followers Routes
     */
    Route::prefix('follower')->group(function () {
        Route::post('/{user_id}/{follower}', 'FollowersController@create')
            ->where(['user_id', 'follower'], '[0-9]+');
        Route::get('/show', 'FollowersController@show');
        Route::delete('/{follower}', 'FollowersController@destroy')
            ->where('follower', '[0-9]+');
    });

    /**
     * Posts Routes
     */
    Route::prefix('posts')->group(function () {
        Route::post('/{user_id}/create', 'PostsController@create')
            ->where('user_id', '[0-9]+');
        Route::put('/{user_id}/{posts}', 'PostsController@edit')
            ->where(['user_id', 'posts'], '[0-9]+');
        Route::get('/{user_id}/{posts}/{quantity}', 'PostsController@show')
            ->where(['user_id', 'posts', 'quantity'], '[0-9]+');
        Route::delete('/{user_id}/{posts}', 'PostsController@destroy')
            ->where(['user_id', 'posts'], '[0-9]+');
    });

    /**
     * Comments Routes
     */
    Route::prefix('comment')->group(function () {
        Route::post('/{user_id}/create', 'CommentsController@create')
            ->where('user_id', '[0-9]+');
        Route::put('/{user_id}/{comment}', 'CommentsController@edit')
            ->where(['user_id', 'comment'], '[0-9]+');
        Route::get('/{user_id}/{comment}', 'CommentsController@show')
            ->where(['user_id', 'comment'], '[0-9]+');
        Route::delete('/{user_id}/{comment}', 'CommentsController@destroy')
            ->where(['user_id', 'comment'], '[0-9]+');
    });

    /**
     * BL Routes
     */
    Route::prefix('black_lists')->group(function () {
        Route::post('/{blacklist}', 'BlackListsController@create')
            ->where('blacklist', '[0-9]+');
        Route::get('/show', 'BlackListsController@show');
        Route::delete('/{blacklist}', 'BlackListsController@destroy')
            ->where('blacklist', '[0-9]+');
    });
});
