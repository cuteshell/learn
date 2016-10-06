<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin'], function () {

    Route::group(['namespace'=>'Admin'], function () {

        Route::get('code', 'CommonController@code');

        Route::group(['middleware'=>['auth']] ,function () {
            Route::get('test', 'IndexController@test');
            Route::get('index', 'IndexController@index');
            Route::get('info', 'IndexController@info');

            Route::resource('category', 'CategoryController');
            Route::post('cate/changeorder', 'CategoryController@changeOrder');

            Route::resource('article', 'ArticleController');

            Route::any('upload', 'CommonController@upload');

            Route::resource('link', 'LinkController');
            Route::post('link/changeorder', 'LinkController@changeOrder');

            Route::resource('nav', 'NavController');
            Route::post('nav/changeorder', 'NavController@changeOrder');
        });
    });

    Route::group(['namespace'=>'Auth'], function () {

        Route::get('login', 'AuthController@getLogin');
        Route::get('register', 'AuthController@getRegister');
        Route::get('logout', 'AuthController@getLogout');

        Route::group(['middleware'=>'code'], function () {
            Route::post('login', 'AuthController@postLogin');
            Route::post('register', 'AuthController@postRegister');
        });

        Route::group(['middleware'=>['auth']], function () {
            Route::get('change', 'PasswordController@getChange');
            Route::post('change', 'PasswordController@postChange');
        });

    });
});




