<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User
Route::group(['middleware' => ['cors']], function() {
    // Cart
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
        Route::post('store/{course_id}','CartController@store');
        Route::get('show','CartController@show');
        Route::get('delete/{id}','CartController@delete');
    });
    Route::group(['prefix' => 'order', 'as' => 'order.'], function() {
        // Order
        Route::post('store','OrderController@store');
        // Verify order
        Route::get('verify','OrderController@verify');
        // Unsubmitted orders in final order page
        Route::get('showCart', 'OrderController@showCart');
        // Submitted orders to be shown for admin and user
        Route::get('showOrder', 'OrderController@showOrder');
        Route::get('userDetails','OrderController@details')->name('userDetails');
        Route::get('delete/{id}','OrderController@delete');
    });
    // Profile
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('store', 'UserController@store');
        Route::get('show', 'UserController@show');
        Route::get('edit', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');
    });
    // Article
    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        Route::get('show', 'ArticleController@show');
        // Details of article shown for user
        Route::get('userDetails', 'ArticleController@userDetails')->name('userDetails');
        // ->middleware('signed') must be pondered with the mixture of laravel and react
    });
     // Course
     Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('show', 'CourseController@show');
        // Details of article shown for user
        Route::get('details', 'CourseController@details');
    });
    // Course comment
    Route::group(['prefix' => 'courseComment', 'as' => 'courseComment.'], function() {
        Route::post('store/{course_id}', 'CourseCommentController@store');
        Route::get('edit', 'CourseCommentController@edit');
        Route::post('update/{course_id}', 'CourseCommentController@update');
        Route::get('delete/{id}','CourseCommentController@delete');
    });
    // Article comment
    Route::group(['prefix' => 'articleComment', 'as' => 'articleComment.'], function() {
        Route::post('store/{article_id}', 'ArticleCommentController@store');
        Route::get('edit', 'ArticleCommentController@edit');
        Route::post('update/{article_id}', 'ArticleCommentController@update');
        Route::get('delete/{id}','ArticleCommentController@delete');
    });
});

// Store Consultation 
Route::post('consultation/store', 'ConsultationController@store')->middleware('storeConsultation');
// Home
Route::get('/', 'HomeController@app')->middleware(['cors']); 
Route::get('home', 'HomeController@index')->middleware(['cors']); 

