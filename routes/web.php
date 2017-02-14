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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('artists', 'ArtistController');
Route::resource('albums', 'AlbumController');
Route::resource('tracks', 'TrackController');

Route::get('/favorites', 'FavoritesController@index');
Route::get('/favorites/tracks/new/{id}', 'FavoritesController@newTrack');
