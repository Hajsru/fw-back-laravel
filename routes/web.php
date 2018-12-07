<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/api/v1'], function() {
    Route::group(['prefix' => '/events'], function() {
        Route::get('/', 'EventController@index');
        Route::get('/{id}', 'EventController@detail');
        Route::get('/{id}/comments', 'EventController@comments');
        Route::get('/{id}/rating', 'EventController@rating');
    });

    Route::group(['prefix' => '/presentations'], function() {
        Route::get('/', 'PresentationController@index');
        Route::get('/{id}', 'PresentationController@detail');
        Route::get('/{id}/comments', 'PresentationController@comments');
        Route::get('/{id}/rating', 'PresentationController@rating');
    });

    Route::get('/speakers', 'SpeakerController@index');
    Route::get('/comments', 'CommentController@index');
    Route::get('/ratings', 'RatingController@index');
});
