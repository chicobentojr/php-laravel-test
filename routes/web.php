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

Route::get('/favorites', 'FavoritesController@index')->name('favorites');
Route::get('/favorites/artists', 'FavoritesController@artists')->name('favorites.artists');
Route::get('/favorites/albums', 'FavoritesController@albums')->name('favorites.albums');
Route::get('/favorites/tracks', 'FavoritesController@tracks')->name('favorites.tracks');
Route::get('/favorites/tracks/save/{id}', 'FavoritesController@saveTrack');
Route::get('/favorites/artists/save/{id}', 'FavoritesController@saveArtist');
Route::get('/favorites/albums/save/{id}', 'FavoritesController@saveAlbum');
