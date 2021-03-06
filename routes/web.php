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

//web page part
Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'HomeController@index');
});


//Admin dashboard part
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/', 'AdminController');

    Route::resource('/contact-us', 'ContactUsController');
    Route::resource('/social', 'SocialController');
    Route::resource('/vacancies', 'VacancyController');
    Route::resource('/catalog', 'CatalogController');

    Route::resource('/newsletters', 'NewsletterController');
    Route::DELETE('/newsletters/{media_id}/destroy-image/{image_id}', 'NewsletterController@destroyImage');

    Route::resource('/press-releases', 'PressReleaseController');
    Route::DELETE('/press-releases/{media_id}/destroy-image/{image_id}', 'NewsletterController@destroyImage');

    Route::prefix('products')->group(function () {
        Route::resource('/', 'ProductController');
        Route::DELETE('/{product_id}/destroy-image/{image_id}', 'ProductController@destroyImage');
        Route::GET('/{id}/specification', 'ProductController@specification');
        Route::POST('/{id}/specification', 'ProductController@specificationStore');
        Route::POST('/ajax-delete', 'ProductController@ajaxDelete');
        Route::POST('/ajax-edit', 'ProductController@ajaxEdit');
        Route::POST('/ajax-get', 'ProductController@ajaxGet');
        Route::GET('/{id}/featured', 'ProductController@featured');
        Route::POST('/{id}/featured-store', 'ProductController@featuredStore');
    });

});
