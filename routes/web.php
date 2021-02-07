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
        Route::get('list', 'AdminController@list')->name('list');
        Route::get('table/list', 'AdminController@adminTable')->name('list.table');
        Route::post('new', 'AdminController@store')->name('store');
        Route::get('edit', 'AdminController@edit')->name('edit');
        Route::get('delete/{id}','AdminController@delete')->name('delete');
    });
    // Course
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('list', 'CourseController@list')->name('list');
        Route::get('table/list', 'CourseController@courseTable')->name('list.table');
        Route::post('new', 'CourseController@store')->name('store');
        Route::get('edit', 'CourseController@edit')->name('edit');
        Route::get('delete/{id}','CourseController@delete')->name('delete');
    });
});

// Authentication
Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');

// User Login
Route::get('/user_dashboard', 'User\DashboardController@index')->middleware('role:user');