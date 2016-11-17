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
Route::get('rml/', 'HomeController@index');
Route::group(['domain' => 'localhost:9000'], function () {

    Route::get('tes', function () {
        // return phpinfo() ;
        $a = Hash::make('bismillah');
        echo $a;
    });
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('users', function () {
        echo "string";
    });
});

Route::get('rml/profil/{organisasi}','HomeController@profil');
Route::get('rml/frontdataset','HomeController@frontdataset');
Route::get('rml/getFrontDataset/{org}','HomeController@getFrontDataset');
Route::get('rml/frontdatadetail/{id}','HomeController@frontdatadetail');
Route::get('rml/download/{file}','HomeController@download');
Route::get('rml/news','HomeController@news');
Route::get('rml/frontberitadetail/{id}','HomeController@frontberitadetail');

Route::auth();

Route::group(['rml/middleware' => ['web', 'auth']], function () {
    Route::get('rml/dashboard','DashboardController@frontpage');

    Route::resource('rml/user','userController');
    Route::get('rml/getUser','userController@getUser');
    Route::get('rml/userProfile','userController@userProfile');

    Route::get('rml/dataset','datasetController@index');
    Route::get('rml/getDataset','datasetController@getDataset');
    Route::get('rml/dataset/create','datasetController@create');
    Route::post('rml/dataset','datasetController@store');
    Route::get('rml/dataset/{id}/edit','datasetController@edit');
    Route::patch('rml/dataset/{id}','datasetController@update');
    Route::delete('rml/dataset/{id}','datasetController@destroy');

    Route::resource('rml/organisasi', 'organisasiController');
    Route::get('rml/getOrganisasi', 'organisasiController@getOrganisasi');

    Route::resource('rml/berita', 'beritaController');
    Route::get('rml/getBerita', 'beritaController@getBerita');
    Route::get('rml/berita/{id}/publish', 'beritaController@publish');
    Route::get('rml/berita/{id}/unpublish', 'beritaController@unpublish');
    Route::get('rml/berita/{id}/headline', 'beritaController@headline');
});
