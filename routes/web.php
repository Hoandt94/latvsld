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
    return view('main.template.index');
});
Route::group(['prefix' => 'assessment'], function () {
    Route::get('/', 'AssessmentController@index')->name('assessment');
    Route::any('/create', 'AssessmentController@create')->name('create_assessment');
    Route::any('/{id}/update', 'AssessmentController@update')->name('update_assessment');
    Route::any('/{id}/detail', 'AssessmentController@detail')->name('get_assessment');
    Route::get('/{id}/delete', 'AssessmentController@delete')->name('delete_assessment');
    Route::get('/reload', 'AssessmentController@reload')->name('reload_assessment');
    Route::get('/{slug}/process', 'AssessmentController@run')->name('run_assessment');
    Route::get('/{slug_assessment}/process/{slug_category}', 'AssessmentController@runCategory')->name('run_category_assessment');
});

Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@postLogin')->name('post_login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::group(['prefix' => 'admin', 'middleware' => ['adminLogin']], function () {
    Route::get('/', function () {
        return view('admin.template.index');
    })->name('admin');

    Route::prefix('set_question')->group(function () {
        Route::get('/', 'SetQuestionController@index')->name('set_question');
        Route::any('/create', 'SetQuestionController@create')->name('create_set_question');
        Route::any('/{id}/update', 'SetQuestionController@update')->name('update_set_question');
        Route::any('/{id}/detail', 'SetQuestionController@detail')->name('get_set_question');
        Route::any('/{id}/config', 'SetQuestionController@config')->name('config_set_question');
        Route::get('/{id}/delete', 'SetQuestionController@delete')->name('delete_set_question');
        Route::get('/reload', 'SetQuestionController@reload')->name('reload_set_question');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::any('/create', 'UserController@create')->name('create_user');
        Route::any('/{id}/update', 'UserController@update')->name('update_user');
        Route::get('/{id}/detail', 'UserController@detail')->name('get_user');
        Route::get('/{id}/delete', 'UserController@delete')->name('delete_user');
        Route::get('/reload', 'UserController@reload')->name('reload_user');
        Route::post('/{id}/change_password', 'UserController@changePassword')->name('change_password_user');
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

    Route::prefix('service_pack')->group(function () {
        Route::get('/', 'ServicePackController@index')->name('service_pack');
        Route::any('/create', 'ServicePackController@create')->name('create_service_pack');
        Route::any('/{id}/update', 'ServicePackController@update')->name('update_service_pack');
        Route::get('/{id}/detail', 'ServicePackController@detail')->name('get_service_pack');
        Route::get('/{id}/delete', 'ServicePackController@delete')->name('delete_service_pack');
        Route::get('/reload', 'ServicePackController@reload')->name('reload_service_pack');
    });

    Route::prefix('company')->group(function () {
        Route::get('/', 'CompanyController@index')->name('company');
        Route::any('/create', 'CompanyController@create')->name('create_company');
        Route::any('/{id}/update', 'CompanyController@update')->name('update_company');
        Route::get('/{id}/detail', 'CompanyController@detail')->name('get_company');
        Route::get('/{id}/delete', 'CompanyController@delete')->name('delete_company');
        Route::get('/reload', 'CompanyController@reload')->name('reload_company');
    });

    Route::prefix('business_type')->group(function () {
        Route::get('/', 'BusinessTypeController@index')->name('business_type');
        Route::any('/create', 'BusinessTypeController@create')->name('create_business_type');
        Route::any('/{id}/update', 'BusinessTypeController@update')->name('update_business_type');
        Route::get('/{id}/detail', 'BusinessTypeController@detail')->name('get_business_type');
        Route::get('/{id}/delete', 'BusinessTypeController@delete')->name('delete_business_type');
        Route::get('/reload', 'BusinessTypeController@reload')->name('reload_business_type');
    });

    Route::prefix('manufacturing_field')->group(function () {
        Route::get('/', 'ManufacturingFieldController@index')->name('manufacturing_field');
        Route::any('/create', 'ManufacturingFieldController@create')->name('create_manufacturing_field');
        Route::any('/{id}/update', 'ManufacturingFieldController@update')->name('update_manufacturing_field');
        Route::get('/{id}/detail', 'ManufacturingFieldController@detail')->name('get_manufacturing_field');
        Route::get('/{id}/delete', 'ManufacturingFieldController@delete')->name('delete_manufacturing_field');
        Route::get('/reload', 'ManufacturingFieldController@reload')->name('reload_manufacturing_field');
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
