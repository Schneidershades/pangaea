<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function(){
	Route::post('/subscribe/{topic}', 'SubscribeController@store');
	Route::post('/publish/{topic}', 'PublishController@store');
});
