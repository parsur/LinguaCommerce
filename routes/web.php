<?php

use Illuminate\Support\Facades\Route;

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


// Middleware
Route::group(['middleware' => ['auth','role:admin']], function () {
    // Admin
    Route::get('adminHome', 'AdminController@admin');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('list', 'AdminController@list');
        Route::get('table/list', 'AdminController@adminTable')->name('list.table');
        Route::post('new', 'AdminController@store');
        Route::get('edit', 'AdminController@edit');
        Route::get('delete/{id}', 'AdminController@delete');
    });
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        // Course
        Route::get('list', 'CourseController@list');
        Route::get('table/list', 'CourseController@courseTable')->name('list.table');
        Route::post('new', 'CourseController@store');
        Route::get('edit', 'CourseController@edit');
        Route::get('delete/{id}','CourseController@delete');
        // Description
        Route::get('newDescription', 'CourseController@newDesc');
        Route::post('description/new', 'CourseController@storeDesc');
    });
    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        // Article
        Route::get('list', 'ArticleController@list');
        Route::get('table/list', 'ArticleController@articleTable')->name('list.table');
        Route::post('new', 'ArticleController@store');
        Route::get('edit', 'ArticleController@edit');
        Route::get('delete/{id}', 'ArticleController@delete');
        // Description
        Route::get('newDescription', 'ArticleController@newDesc');
        Route::post('description/new', 'ArticleController@storeDesc');
    });
});

// Authentication
Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');

// User Login
Route::get('/user_dashboard', 'UserController@index')->middleware(['auth','role:user']);