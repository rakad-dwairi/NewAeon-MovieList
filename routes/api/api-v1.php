<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('movies', 'MovieController');
    Route::apiResource('actors', 'ActorController');
});


