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
Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@postLogin')->name('post_login');
Route::get('/logout', 'UserController@logout');
Route::group(['prefix' => 'admin', 'middleware' => ['adminLogin']], function () {
    Route::get('/', function () {
        return view('admin.template.index');
    });
    Route::prefix('group_user')->group(function () {
        Route::get('/', 'GroupUserController@index')->name('group_user');
        Route::any('/create', 'GroupUserController@create')->name('create_group_user');
        Route::get('/:id', 'GroupUserController@detail')->name('detail_group_user');
        Route::any('/:id/update', 'GroupUserController@update')->name('update_group_user');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::any('/create', 'UserController@create')->name('create_user');
        Route::any('/{id}/update', 'UserController@update')->name('update_user');
        Route::get('/{id}/detail', 'UserController@detail')->name('get_user');
        Route::get('/{id}/delete', 'UserController@delete')->name('delete_user');
        Route::get('/reload', 'UserController@reload')->name('reload_user');
    });
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category');
        Route::any('/create', 'CategoryController@create')->name('create_category');
        Route::any('/{id}/update', 'CategoryController@update')->name('update_category');
        Route::get('/{id}/detail', 'CategoryController@detail')->name('get_category');
        Route::get('/{id}/delete', 'CategoryController@delete')->name('delete_category');
        Route::get('/reload', 'CategoryController@reload')->name('reload_category');
    });
    Route::prefix('question')->group(function () {
        Route::get('/', 'QuestionController@index')->name('question');
        Route::any('/create', 'QuestionController@create')->name('create_question');
        Route::any('/{id}/update', 'QuestionController@update')->name('update_question');
        Route::get('/{id}/detail', 'QuestionController@detail')->name('get_question');
        Route::get('/{id}/delete', 'QuestionController@delete')->name('delete_question');
        Route::get('/reload', 'QuestionController@reload')->name('reload_question');
    });

    Route::prefix('business_type')->group(function () {
        Route::get('/', 'BusinessTypeController@index')->name('business_type');
        Route::any('/create', 'BusinessTypeController@create')->name('create_business_type');
        Route::any('/{id}/update', 'BusinessTypeController@update')->name('update_business_type');
        Route::get('/{id}/detail', 'BusinessTypeController@detail')->name('get_business_type');
        Route::get('/{id}/delete', 'BusinessTypeController@delete')->name('delete_business_type');
        Route::get('/reload', 'BusinessTypeController@reload')->name('reload_business_type');
    });

    Route::prefix('business_type')->group(function () {
        Route::get('/', 'BusinessTypeController@index')->name('business_type');
        Route::any('/create', 'BusinessTypeController@create')->name('create_business_type');
        Route::any('/{id}/update', 'BusinessTypeController@update')->name('update_business_type');
        Route::get('/{id}/detail', 'BusinessTypeController@detail')->name('get_business_type');
        Route::get('/{id}/delete', 'BusinessTypeController@delete')->name('delete_business_type');
        Route::get('/reload', 'BusinessTypeController@reload')->name('reload_business_type');
    });

    Route::prefix('manufactoring_field')->group(function () {
        Route::get('/', 'ManufactoringFieldController@index')->name('manufactoring_field');
        Route::any('/create', 'ManufactoringFieldController@create')->name('create_manufactoring_field');
        Route::any('/{id}/update', 'ManufactoringFieldController@update')->name('update_manufactoring_field');
        Route::get('/{id}/detail', 'ManufactoringFieldController@detail')->name('get_manufactoring_field');
        Route::get('/{id}/delete', 'ManufactoringFieldController@delete')->name('delete_manufactoring_field');
        Route::get('/reload', 'ManufactoringFieldController@reload')->name('reload_manufactoring_field');
    });

    Route::prefix('specific_profession')->group(function () {
        Route::get('/', 'SpecificProfessionController@index')->name('specific_profession');
        Route::any('/create', 'SpecificProfessionController@create')->name('create_specific_profession');
        Route::any('/{id}/update', 'SpecificProfessionController@update')->name('update_specific_profession');
        Route::get('/{id}/detail', 'SpecificProfessionController@detail')->name('get_specific_profession');
        Route::get('/{id}/delete', 'SpecificProfessionController@delete')->name('delete_specific_profession');
        Route::get('/reload', 'SpecificProfessionController@reload')->name('reload_specific_profession');
    });
});
