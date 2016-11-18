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
Route::get('/', 'HomeController@index');
Route::get('tes', function () {
    // return phpinfo() ;
    $a = Hash::make('bismillah');
    echo $a;
});

Route::get('profil/{organisasi}','HomeController@profil');
Route::get('frontdataset','HomeController@frontdataset');
Route::get('getFrontDataset/{org}','HomeController@getFrontDataset');
Route::get('frontdatadetail/{id}','HomeController@frontdatadetail');
Route::get('download/{file}','HomeController@download');
Route::get('news','HomeController@news');
Route::get('frontberitadetail/{id}','HomeController@frontberitadetail');

Route::auth();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/dashboard','DashboardController@frontpage');

    Route::resource('user','userController');
    Route::get('getUser','userController@getUser');
    Route::get('userProfile','userController@userProfile');

    Route::get('dataset','datasetController@index');
    Route::get('getDataset','datasetController@getDataset');
    Route::get('dataset/create','datasetController@create');
    Route::post('dataset','datasetController@store');
    Route::get('dataset/{id}/edit','datasetController@edit');
    Route::patch('dataset/{id}','datasetController@update');
    Route::delete('dataset/{id}','datasetController@destroy');

    Route::resource('organisasi', 'organisasiController');
    Route::get('getOrganisasi', 'organisasiController@getOrganisasi');

    Route::resource('berita', 'beritaController');
    Route::get('getBerita', 'beritaController@getBerita');
    Route::get('berita/{id}/publish', 'beritaController@publish');
    Route::get('berita/{id}/unpublish', 'beritaController@unpublish');
    Route::get('berita/{id}/headline', 'beritaController@headline');

    Route::resource('slider','sliderController');
});
