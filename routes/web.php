<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.template.index');
    });
    Route::prefix('group_user')->group(function () {
        Route::get('/', 'GroupUserController@index');
        Route::post('/create', 'GroupUserController@create');
        Route::get('/:id', 'GroupUserController@detail');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index');
        Route::post('/create', 'UserController@create');
        Route::get('/:id', 'UserController@detail');
    });
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index');
        Route::post('/create', 'CategoryController@create');
        Route::get('/:id', 'CategoryController@detail');
    });
    Route::prefix('question')->group(function () {
        Route::get('/', 'QuestionController@index');
        Route::post('/create', 'QuestionController@create');
        Route::get('/:id', 'QuestionController@detail');
    });
});
