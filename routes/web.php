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


Route::post('/image/upload', function(){
    // return json_encode('location');
});
// Middleware
Route::group(['middleware' => ['auth','isAdmin']], function () {
    // Admin
    Route::get('adminHome', 'AdminController@admin');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('list', 'AdminController@list');
        Route::get('table/list', 'AdminController@adminTable')->name('list.table');
        Route::post('store', 'AdminController@store');
        Route::get('edit', 'AdminController@edit');
        Route::get('delete/{id}', 'AdminController@delete');
    });
    // Video
    Route::group(['prefix' => 'video', 'as' => 'video.'], function () {
        Route::get('list', 'VideoController@list');
        Route::get('table/list', 'VideoController@videoTable')->name('list.table');
        Route::post('store', 'VideoController@store');
        Route::get('edit', 'VideoController@edit');
        Route::get('delete/{id}', 'VideoController@delete');
    });
    // Course
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('list', 'CourseController@list');
        Route::get('table/list', 'CourseController@courseTable')->name('list.table');
        Route::get('new', 'CourseController@new')->name('new');
        Route::post('store', 'CourseController@store');
        Route::get('delete/{id}','CourseController@delete');
        Route::get('edit', 'CourseController@edit');
        // Details shown for admin
        Route::get('adminDetails', 'CourseController@adminDetails')->name('adminDetails');
        // Details shown for user
        Route::get('userDetails', 'CourseController@userDetails')->name('userDetails')->middleware('signed');
        // Search
        Route::post('search', 'CourseController@search');
    });
    // Course Image
    Route::group(['prefix' => 'courseImage', 'as' => 'courseImage.'], function () {
        Route::get('list', 'course\ImageController@list');
        Route::get('table/list', 'course\ImageController@courseImageTable')->name('list.table');
        Route::post('store', 'course\ImageController@store');
        Route::get('edit', 'course\ImageController@edit');
        Route::get('delete/{id}', 'course\ImageController@delete');
    });
    // Course Video
    Route::group(['prefix' => 'courseVideo', 'as' => 'courseVideo.'], function () {
        Route::get('list', 'course\VideoController@list');
        Route::get('table/list', 'course\VideoController@courseVideoTable')->name('list.table');
        Route::post('store', 'course\VideoController@store');
        Route::get('edit', 'course\VideoController@edit');
        Route::get('delete/{id}', 'course\VideoController@delete');
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
        Route::get('list', 'article\ImageController@list');
        Route::get('table/list', 'article\ImageController@articleImageTable')->name('list.table');
        Route::post('store', 'article\ImageController@store');
        Route::get('edit', 'article\ImageController@edit');
        Route::get('delete/{id}', 'article\ImageController@delete');
    });
    // Article Video
    Route::group(['prefix' => 'articleVideo', 'as' => 'articleVideo.'], function () {
        Route::get('list', 'article\VideoController@list');
        Route::get('table/list', 'article\VideoController@articleVideoTable')->name('list.table');
        Route::post('store', 'article\VideoController@store');
        Route::get('edit', 'article\VideoController@edit');
        Route::get('delete/{id}', 'article\VideoController@delete');
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
        Route::get('table/list','OrderController@orderTable')->name('list.table');
        Route::get('details','OrderController@details')->name('details');
        Route::get('delete/{id}','OrderController@delete');
    });
    // Course file
    Route::group(['prefix' => 'courseFile', 'as' => 'courseFile.'], function() {
        // File
        Route::get('download', 'Course\FileController@download');
        Route::get('list','Course\FileController@list');
        Route::get('table/list','Course\FileController@courseFileTable')->name('list.table');
        Route::post('store', 'Course\FileController@store');
        Route::get('edit', 'Course\FileController@edit');
        Route::get('delete/{id}','Course\FileController@delete');
    });
    // Course comment
    Route::group(['prefix' => 'courseComment', 'as' => 'courseComment.'], function() {
        Route::get('list','Course\CommentController@list');
        Route::get('table/list','Course\CommentController@courseCommentTable')->name('list.table');
        Route::post('submit', 'Course\CommentController@submit');
    });
    // Article comment
    Route::group(['prefix' => 'articleComment', 'as' => 'articleComment.'], function() {
        Route::get('list','article\CommentController@list');
        Route::get('table/list','article\CommentController@articleCommentTable')->name('list.table');
        Route::post('submit', 'article\CommentController@submit');
    });
    // Home Setting
    Route::group(['prefix' => 'homeSetting', 'as' => 'homeSetting.'], function() {
        // Home Setting
        Route::get('new','HomeSettingController@new');
        Route::post('store','HomeSettingController@store');
    });
});



// Authentication 
Auth::routes();
Route::get('login','Auth\LoginController@index')->name('login');
Route::post('login', 'Auth\LoginController@store');
// Forgotten password
Route::get('/forgot-password', 'Auth\ForgotPasswordController@index');
// logout
Route::get('/logout','Auth\LoginController@logout')->name('logout');

// Home
Route::get('/', 'HomeController@index')->middleware('cors');
Route::post('search', 'HomeController@search');

// User 
Route::group(['middleware' => ['auth']], function() {
    // Cart
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
        Route::get('show','CartController@show');
        Route::post('store/{course_id}','CartController@store');
        Route::get('delete/{id}','CartController@delete');
    });
    Route::group(['prefix' => 'order', 'as' => 'order.'], function() {
        // Order
        Route::post('store','OrderController@store');
        // Unsubmitted orders in final order page
        Route::get('showCart', 'OrderController@showCart');
        // Submitted orders to be shown for admin and user
        Route::get('showOrder', 'OrderController@showOrder');
        Route::get('details','OrderController@details')->name('details');
        Route::get('delete/{id}','OrderController@delete');
    });
    // Profile
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('show', 'UserController@show');
        Route::post('store', 'UserController@store');
        Route::get('edit', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');
    });
    // Course comment
    Route::group(['prefix' => 'courseComment', 'as' => 'courseComment.'], function() {
        Route::post('store/{course_id}', 'CourseCommentController@store');
        Route::get('edit/{course_id}', 'CourseCommentController@edit');
        Route::post('update/{course_id}', 'CourseCommentController@update');
        Route::get('delete/{id}','CourseCommentController@delete');
    });
    // Article comment
    Route::group(['prefix' => 'articleComment', 'as' => 'articleComment.'], function() {
        Route::post('store/{article_id}', 'ArticleCommentController@store');
        Route::get('edit/{article_id}', 'ArticleCommentController@edit');
        Route::post('update/{article_id}', 'ArticleCommentController@update');
        Route::get('delete/{id}','ArticleCommentController@delete');
    });
});

// App
Route::get('/', function () {
    return view('app');
});
