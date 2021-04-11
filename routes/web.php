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

// Admin
Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    // Admin
    Route::get('admin/home', 'AdminController@admin');
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
        Route::get('details', 'CourseController@details')->name('details')->middleware('signed');
    });
    // Course Image
    Route::group(['prefix' => 'courseImage', 'as' => 'courseImage.'], function () {
        Route::get('list', 'Course\ImageController@list');
        Route::get('table/list', 'Course\ImageController@courseImageTable')->name('list.table');
        Route::post('store', 'Course\ImageController@store');
        Route::get('edit', 'Course\ImageController@edit');
        Route::get('delete/{id}', 'Course\ImageController@delete');
    });
    // Course Video
    Route::group(['prefix' => 'courseVideo', 'as' => 'courseVideo.'], function () {
        Route::get('list', 'Course\VideoController@list');
        Route::get('table/list', 'Course\VideoController@courseVideoTable')->name('list.table');
        Route::post('store', 'Course\VideoController@store');
        Route::get('edit', 'Course\VideoController@edit');
        Route::get('delete/{id}', 'Course\VideoController@delete');
    });
    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        // Article
        Route::get('list', 'ArticleController@list');
        Route::get('table/list', 'ArticleController@articleTable')->name('list.table');
        Route::get('new', 'ArticleController@new')->name('newArticle');
        Route::post('store', 'ArticleController@store');
        Route::get('edit', 'ArticleController@edit');
        // Admin details
        Route::get('details', 'ArticleController@details')->name('details')->middleware('signed');
        Route::get('delete/{id}', 'ArticleController@delete');
    });
     // Article Video
     Route::group(['prefix' => 'articleImage', 'as' => 'articleImage.'], function () {
        Route::get('list', 'Article\ImageController@list');
        Route::get('table/list', 'Article\ImageController@articleImageTable')->name('list.table');
        Route::post('store', 'Article\ImageController@store');
        Route::get('edit', 'Article\ImageController@edit');
        Route::get('delete/{id}', 'Article\ImageController@delete');
    });
    // Article Video
    Route::group(['prefix' => 'articleVideo', 'as' => 'articleVideo.'], function () {
        Route::get('list', 'Article\VideoController@list');
        Route::get('table/list', 'Article\VideoController@articleVideoTable')->name('list.table');
        Route::post('store', 'Article\VideoController@store');
        Route::get('edit', 'Article\VideoController@edit');
        Route::get('delete/{id}', 'Article\VideoController@delete');
    });
    // Sub categories based on categories   
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
        Route::get('details','OrderController@details')->name('details')->middleware('signed');
        Route::get('delete/{id}','OrderController@delete');
    });
    // Course file
    Route::group(['prefix' => 'courseFile', 'as' => 'courseFile.'], function() {
        // File
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
        Route::get('details', 'Course\CommentController@details')->name('details')->middleware('signed');
        Route::post('submit', 'Course\CommentController@submit');
    });
    // Article comment
    Route::group(['prefix' => 'articleComment', 'as' => 'articleComment.'], function() {
        Route::get('list','Article\CommentController@list');
        Route::get('table/list','Article\CommentController@articleCommentTable')->name('list.table');
        Route::get('details', 'Article\CommentController@details')->name('details')->middleware('signed');
        Route::post('submit', 'Article\CommentController@submit');
    });
    // Consultation
    Route::group(['prefix' => 'consultation', 'as' => 'consultation.'], function() {
        Route::get('list', 'ConsultationController@list');
        Route::get('table/list', 'ConsultationController@consultationTable')->name('list.table');
        Route::get('details', 'ConsultationController@details')->name('details');
        Route::get('delete/{id}', 'ConsultationController@delete');
    });
    // Home Setting
    Route::group(['prefix' => 'homeSetting', 'as' => 'homeSetting.'], function() {
        // Home Setting
        Route::get('new','HomeSettingController@new');
        Route::post('store','HomeSettingController@store');
    });
    // Why me
    Route::group(['prefix' => 'whyMe', 'as' => 'whyMe.'], function() {
        Route::get('new', 'WhyMeController@new');
        Route::post('store','WhyMeController@store');
    });
});

// Authentication 
Auth::routes(['verify' => true]);
// Forgotten password
Route::get('/forgot-password', 'Auth\ForgotPasswordController@index');
// Warning verification
Route::get('/email/verify', 'Auth\VerificationController@noticeVerification')->middleware('auth')->name('verification.notice');
// Email vertification 
Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@finalVerification')->middleware(['auth', 'signed'])->name('verification.verify');
// logout
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@app');

// React app
Route::view('/{path?}', 'app');
Route::view('/{path?}/{id}', 'app');
