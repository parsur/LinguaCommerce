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
Route::group(['prefix' => 'v1', 'as' => 'v1.', 'middleware' => 'apiKey'], function() {  // verified
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
        Route::get('details','OrderController@details');
        Route::get('delete/{id}','OrderController@delete');
    });
    // Article
    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        Route::get('show', 'ArticleController@show');
        // Details of article shown for user
        Route::get('details', 'ArticleController@details');
        // Search
        Route::post('search', 'ArticleController@search');
    });
    // Course
    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('show', 'CourseController@show');
        // Details of article shown for user
        Route::get('details', 'CourseController@details');
        // Search
        Route::post('search', 'CourseController@search');
    });
    // Course comment
    Route::group(['prefix' => 'courseComment', 'as' => 'courseComment.'], function() {
        Route::post('store', 'Course\CommentController@store');
        Route::get('edit', 'Course\CommentController@edit');
        Route::post('update', 'Course\CommentController@update');
        Route::get('delete/{id}','Course\CommentController@delete');
    });
    // Article comment
    Route::group(['prefix' => 'articleComment', 'as' => 'articleComment.'], function() {
        Route::post('store', 'Article\CommentController@store');
        Route::get('edit', 'Article\CommentController@edit');
        Route::post('update', 'Article\CommentController@update');
        Route::get('delete/{id}','Article\CommentController@delete');
    });

    // Profile
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth:sanctum'], function() { 
        Route::post('store', 'UserController@store');
        Route::get('show', 'UserController@show');
        Route::get('edit', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');
    });

    // Sub categories based on categories   
    Route::get('/subCategory', 'CategoryController@ajax_subCategory');

    // Store Consultation 
    Route::post('consultation/store', 'ConsultationController@store')->middleware('storeConsultation');
    // App
    Route::get('/', 'HomeController@app'); 
    // Home
    Route::get('home', 'HomeController@index');
    // Login
    Route::post('login', 'Auth\LoginController@user');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('logout', 'Auth\LoginController@logout'); 
});





