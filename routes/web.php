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
        // Admin details
        Route::get('adminDetails', 'CourseController@adminDetails')->name('adminDetails');
        // User details
        Route::get('userDetails', 'CourseController@userDetails')->name('userDetails')->middleware('signed');
        Route::post('store', 'CourseController@store');
        Route::get('delete/{id}','CourseController@delete');
        // Search
        Route::post('search', 'CourseController@search');
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
        // Admin details
        Route::get('adminDetails', 'ArticleController@adminDetails')->name('adminDetails');
        // User details
        Route::get('userDetails', 'ArticleController@userDetails')->name('userDetails')->middleware('signed');
        Route::get('delete/{id}', 'ArticleController@delete');
        // Search
        Route::post('search', 'ArticleController@search');
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
        Route::post('store','SubCategoryController@store');
        Route::get('edit','SubCategoryController@edit');
        Route::get('delete/{id}','SubCategoryController@delete');
    });
    // User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('list', 'UserController@list');
        Route::get('table/list', 'UserController@userTable')->name('list.table');
        Route::post('store', 'UserController@store');
        Route::get('edit', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');
    });
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        // Order
        Route::get('list','OrderController@list');
        Route::get('table/list','OrderController@orderTable')->name('order.list.table');
        Route::get('delete/{id}','OrderController@delete');
    });
});

// Authentication {
    Auth::routes();
    Route::get('login','Auth\LoginController@index')->name('login');
    Route::post('login', 'Auth\LoginController@store');
    // Forgotten password
    Route::get('/forgot-password', 'Auth\ForgotPasswordController@index');
    // logout
    Route::get('/logout','Auth\LoginController@logout')->name('logout');
//}

// Home
Route::get('home', 'HomeController@index');
Route::post('search', 'HomeController@search');

// User 
Route::group(['middleware' => ['auth','role:user']], function() {
    // Dashboard
    Route::get('/user_dashboard', 'UserController@index')->middleware(['auth','role:user']);
    // Cart
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
        Route::get('index','CartController@index');
        Route::post('store/{course_id}','CartController@store');
        Route::get('delete/{id}','CartController@delete');
    });
    Route::group(['prefix' => 'order', 'as' => 'order.'], function() {
        // Order
        Route::post('store','OrderController@store');
        Route::get('user/delete/{id}','OrderController@delete');
    });
    // Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('index', 'ProfileController@list');
        Route::get('edit', 'ProfileController@edit');
        Route::get('delete/{id}', 'ProfileController@delete');
    });
});


Route::view('/{path?}', 'app');