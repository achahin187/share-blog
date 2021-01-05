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
Route::group(['prefix' =>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    /////route for HomePage
    Route::resource('/home', 'homeController');
    ///////route for about
    Route::get('/about', 'aboutController@index');
    ///////route for contact
    Route::get('/contact', 'contactController@index');
    //////route for profile 
    Route::resource('/profile', 'profileController');
    ////////////route for store users--->sodium_crypto_sign
    Route::post('/signup', 'signupController@signup')->name('signup');
    ///////routefor login
    Route::post('/login', 'loginController@login')->name('login');
    ////route for logout
    Route::get('/logout', 'signupController@logout')->name('logout');
    ////route for posts
    Route::resource('/post', 'postController');
    ////route for category 
    Route::resource('/category', 'categoryController');
    ///route for comments
    Route::resource('/comment', 'commentController');
    ///route for favorite 
    Route::resource('/favorite', 'favoriteController');


});

