<?php

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('home', 'HomeController@index')->name('home');

Route::get('register', 'Auth\RegisterController@create')->name('register');
Route::post('register', 'Auth\RegisterController@handleCreate');

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@handleLogin');

Route::get('logout', 'Auth\LogoutController@logout')->name('logout');

Route::group(array('prefix' => 'storage', 'before' => 'auth'), function () {
    Route::get('app/{filename}', 'FileController@getAgreement')->where('filename', '^[^/]+$');
});

Route::group(['prefix' => 'reports'], function () {
    Route::get('outstandingapplicants', 'ReportController@outstandingApplicants')->name('outstandingapplicants');
    Route::get('outstandingapplications', 'ReportController@outstandingApplications')->name('outstandingapplications');
    Route::get('fundedperdegreetype', 'ReportController@fundedPerDegreeType')->name('fundedperdegreetype');
});

Route::group(['prefix' => 'applications'], function () {
    Route::model('application', 'App\Application');

    Route::get('', 'ApplicationController@index')->name('applications');
    Route::get('view/{application}', 'ApplicationController@view')->name('applications/view');

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

Route::group(['prefix' => 'administrators'], function () {
    Route::model('administrator', 'App\Administrator');

    Route::get('', 'AdministratorController@index')->name('administrators');

    Route::get('create', 'AdministratorController@create')->name('administrators/create');
    Route::post('create', 'AdministratorController@handleCreate');

    Route::get('edit/{administrator}', 'AdministratorController@edit')->name('administrators/edit');
    Route::post('edit/{administrator}', 'AdministratorController@handleEdit');

    Route::post('delete/{administrator}', 'AdministratorController@handleDelete')->name('administrators/delete');
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

Route::group(['prefix' => 'fundingtypes'], function () {
    Route::model('funding_type', 'App\FundingType');

    Route::get('', 'FundingTypeController@index')->name('fundingtypes');

    Route::get('create', 'FundingTypeController@create')->name('fundingtypes/create');
    Route::post('create', 'FundingTypeController@handleCreate');

    Route::get('edit/{funding_type}', 'FundingTypeController@edit')->name('fundingtypes/edit');
    Route::post('edit/{funding_type}', 'FundingTypeController@handleEdit');

    Route::post('delete/{funding_type}', 'FundingTypeController@handleDelete')->name('fundingtypes/delete');
});

Route::group(['prefix' => 'donationprofiles'], function () {
    Route::model('donation_profile', 'App\DonationProfile');

    Route::get('', 'DonationProfileController@index')->name('donationprofiles');

    Route::get('create', 'DonationProfileController@create')->name('donationprofiles/create');
    Route::post('create', 'DonationProfileController@handleCreate');

    Route::get('edit/{donation_profile}', 'DonationProfileController@edit')->name('donationprofiles/edit');
    Route::post('edit/{donation_profile}', 'DonationProfileController@handleEdit');

    Route::post('delete/{donation_profile}', 'DonationProfileController@handleDelete')->name('donationprofiles/delete');
});

Route::group(['prefix' => 'donations'], function () {
    Route::model('donation', 'App\Donation');

    Route::get('', 'DonationController@index')->name('donations');

    Route::get('create', 'DonationController@create')->name('donations/create');
    Route::post('create', 'DonationController@handleCreate');

    Route::get('edit/{donation}', 'DonationController@edit')->name('donations/edit');
    Route::post('edit/{donation}', 'DonationController@handleEdit');

    Route::post('delete/{donation}', 'DonationController@handleDelete')->name('donations/delete');
});