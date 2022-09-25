<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/lang/{lang}', [LanguageController::class, 'lang']);

Auth::routes(['reset' => FALSE]);
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'lang'], function () {
    Route::get('/', 'HomeController@index');
});
Route::get('/search', 'HomeController@search');
Route::post('/message', 'HomeController@message');

Route::get('/movies', 'MovieController@index');
Route::get('/movies/{film}', 'MovieController@show');
Route::get('/series', 'SeriesController@index');
Route::get('/series/{serie}', 'SeriesController@show');
Route::get('/episodes/{episode}', 'SeriesController@episodeshow');
Route::get('/ads', 'GoogleAdsController@index');
Route::get('/movies/adv', 'MovieController@ads');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/profile', 'ClientController@profile');
    Route::put('/user/profile/{user}', 'ClientController@updateProfile');
    Route::get('/user/change_password', 'ClientController@changePasswordForm');
    Route::put('/user/change_password/{user}', 'ClientController@changePassword');
    Route::get('/user/favorites', 'ClientController@favorites');
    Route::get('/user/ratings', 'ClientController@ratings');
    Route::get('/user/reviews', 'ClientController@reviews');
    Route::get('/user/reviews', 'ClientController@reviews');

    Route::post('/user/addToFavorite/{film}', 'FavoriteController@store');
    Route::post('/user/removeFromFavorite/{film}', 'FavoriteController@destroy');

    Route::post('/user/rate/{film}', 'RateController@store');

    Route::post('/user/review/{film}', 'ReviewController@store');
    Route::delete('/user/review/{film}', 'ReviewController@destroy');
});
 
Route::post('/set-url', 'MovieController@setEmpdUrl');
Route::post('/set-serieURL', 'SeriesController@setEmpdUrl');

