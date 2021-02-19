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
        Route::post('store', 'AdminController@store');
        Route::get('edit', 'AdminController@edit');
        Route::get('delete/{id}', 'AdminController@delete');
    });
    // Course
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('list', 'CourseController@list');
        Route::get('table/list', 'CourseController@courseTable')->name('list.table');
        Route::get('new', 'CourseController@new')->name('new');
        Route::get('edit', 'CourseController@edit');
        Route::get('details', 'CourseController@details')->name('details');
        Route::post('store', 'CourseController@store');
        Route::get('delete/{id}','CourseController@delete');
    });
    // Course Image
    Route::group(['prefix' => 'courseImage', 'as' => 'courseImage.'], function () {
        Route::get('list', 'CourseImageController@list');
        Route::get('table/list', 'CourseImageController@courseImageTable')->name('list.table');
        Route::post('store', 'CourseImageController@store');
        Route::get('edit', 'CourseImageController@edit');
        Route::get('delete/{id}', 'CourseImageController@delete');
    });
    // Course Video
    Route::group(['prefix' => 'courseVideo', 'as' => 'courseVideo.'], function () {
        Route::get('list', 'CourseVideoController@list');
        Route::get('table/list', 'CourseVideoController@courseVideoTable')->name('list.table');
        Route::post('store', 'CourseVideoController@store');
        Route::get('edit', 'CourseVideoController@edit');
        Route::get('delete/{id}', 'CourseVideoController@delete');
    });
    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        // Article
        Route::get('list', 'ArticleController@list');
        Route::get('table/list', 'ArticleController@articleTable')->name('list.table');
        Route::get('new', 'ArticleController@new')->name('newArticle');
        Route::post('store', 'ArticleController@store');
        Route::get('edit', 'ArticleController@edit');
        Route::get('details', 'ArticleController@details')->name('details');
        Route::get('delete/{id}', 'ArticleController@delete');
    });
     // Article Video
     Route::group(['prefix' => 'articleImage', 'as' => 'articleImage.'], function () {
        Route::get('list', 'ArticleImageController@list');
        Route::get('table/list', 'ArticleImageController@articleImageTable')->name('list.table');
        Route::post('store', 'ArticleImageController@store');
        Route::get('edit', 'ArticleImageController@edit');
        Route::get('delete/{id}', 'ArticleImageController@delete');
    });
    // Article Video
    Route::group(['prefix' => 'articleVideo', 'as' => 'articleVideo.'], function () {
        Route::get('list', 'ArticleVideoController@list');
        Route::get('table/list', 'ArticleVideoController@articleVideoTable')->name('list.table');
        Route::post('store', 'ArticleVideoController@store');
        Route::get('edit', 'ArticleVideoController@edit');
        Route::get('delete/{id}', 'ArticleVideoController@delete');
    });
    // Sub Categories based on Categories   
    Route::get('/subCategory', 'CategoryController@ajax_subCategory');
    // Categories
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('list', 'CategoryController@list');
        Route::get('table/list', 'CategoryController@categoryTable')->name('list.table');
        Route::post('store', 'CategoryController@store');
        Route::get('edit', 'CategoryController@edit');
        Route::get('delete/{id}','CategoryController@delete');
    });
     // Sub Categories
     Route::group(['prefix' => 'subCategory', 'as' => 'subCategory.'], function() {
        Route::get('list','SubCategoryController@list');
        Route::get('table/list','SubCategoryController@subCategoryTable')->name('list.table');
        Route::post('store  ','SubCategoryController@store');
        Route::get('edit','SubCategoryController@edit');
        Route::get('delete/{id}','SubCategoryController@delete');
    });
});

// Authentication
Auth::routes();
// Login
Route::get('login','LoginController@index')->name('login');

Route::post('login', 'Auth\LoginController@store');
// Forgotten password
Route::get('/forgot-password', 'Auth\ForgotPasswordController@index');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
// Home
Route::get('/', 'HomeController@index')->name('home');

// User Login
Route::get('/user_dashboard', 'UserController@index')->middleware(['auth','role:user']);