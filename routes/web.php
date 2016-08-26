<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', 'HomeController@index')->name('home');

Route::get('register', 'Auth\RegisterController@create')->name('register');
Route::post('register', 'Auth\RegisterController@handleCreate');

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@handleLogin');

Route::get('logout', 'Auth\LogoutController@logout')->name('logout');

Route::group(['prefix' => 'applications'], function () {
    Route::model('application', 'App\Application');

    Route::get('', 'ApplicationController@index')->name('applications');

    Route::get('create', 'ApplicationController@create')->name('applications/create');
    Route::post('create', 'ApplicationController@handleCreate');

    Route::get('edit/{application}', 'ApplicationController@edit')->name('applications/edit');
    Route::post('edit/{application}', 'ApplicationController@handleEdit');

    Route::post('delete/{application}', 'ApplicationController@handleDelete')->name('applications/delete');
});