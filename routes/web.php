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

Route::group(['prefix' => 'applicants'], function () {
    Route::model('applicant', 'App\Applicant');

    Route::get('', 'ApplicantController@index')->name('applicants');

    Route::get('create', 'ApplicantController@create')->name('applicants/create');
    Route::post('create', 'ApplicantController@handleCreate');

    Route::get('edit/{applicant}', 'ApplicantController@edit')->name('applicants/edit');
    Route::post('edit/{applicant}', 'ApplicantController@handleEdit');

    Route::post('delete/{applicant}', 'ApplicantController@handleDelete')->name('applicants/delete');
});

Route::group(['prefix' => 'donors'], function () {
    Route::model('donor', 'App\Donor');

    Route::get('', 'DonorController@index')->name('donors');

    Route::get('create', 'DonorController@create')->name('donors/create');
    Route::post('create', 'DonorController@handleCreate');

    Route::get('edit/{donor}', 'DonorController@edit')->name('donors/edit');
    Route::post('edit/{donor}', 'DonorController@handleEdit');

    Route::post('delete/{donor}', 'DonorController@handleDelete')->name('donors/delete');
});