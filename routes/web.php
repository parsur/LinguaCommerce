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


Route::post('/home/profile/about/img', function(){
    return json_encode(['location' => '/storage/app/public/pictures/bestAvatar.png' ]);
});

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
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        // Course
        Route::get('list', 'CourseController@list');
        Route::get('table/list', 'CourseController@courseTable')->name('list.table');
        Route::get('new', 'CourseController@new')->name('newCourse');
        Route::get('edit', 'CourseController@edit');
        Route::post('store', 'CourseController@store');
        Route::get('delete/{id}','CourseController@delete');
        // Description
        Route::get('eachDescription', 'CourseController@eachDesc')->name('eachDesc')->middleware('signed');
    });
    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        // Article
        Route::get('list', 'ArticleController@list');
        Route::get('table/list', 'ArticleController@articleTable')->name('list.table');
        Route::get('new', 'ArticleController@new')->name('newArticle');
        Route::post('store', 'ArticleController@store');
        Route::get('edit', 'ArticleController@edit');
        Route::get('delete/{id}', 'ArticleController@delete');
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
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');

// User Login
Route::get('/user_dashboard', 'UserController@index')->middleware(['auth','role:user']);