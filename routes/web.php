<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/send_email', 'HomeController@sendEmail')->name('home');
Route::get('/about_me', 'HomeController@about_me')->name('about_me');
Route::get('/prices', 'HomeController@prices')->name('prices');
Route::get('/prices/exchange', 'HomeController@exchangeRatePrice');
Route::get('/articles', 'ArticlesController@articles')->name('articles');
Route::get('/articles/category_{slug}', 'ArticlesController@articlesCategory')->name('articles');
Route::get('articles/{slug}','ArticlesController@article')->name('articles');
Route::post('articles/{slug}/create_comment', 'CommentsController@saveComment');
//Route::post('/articles/id_{id}/create', 'ArticlesController@saveComment')-> name('create');
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/{slug}/browse', 'AdminController@browse');
    Route::get('/{slug}/show/{id}', 'AdminController@show');
    Route::get('/{slug}/edit/{id}', 'AdminController@edit');
    Route::post('/{slug}/update/{id}', 'AdminController@update');
    Route::get('/{slug}/add', 'AdminController@add');
    Route::post('/{slug}/create', 'AdminController@createRecord');
    Route::delete('/{slug}/delete/{id}', 'AdminController@deleteRecord');
});
