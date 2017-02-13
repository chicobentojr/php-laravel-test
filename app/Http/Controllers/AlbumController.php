<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Image;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Album::all();
    }

    public function create()
    {
      $url = 'https://api.spotify.com/v1/albums/0sNOF9WDwhWunNAHPD3Baj';

      $data = json_decode(file_get_contents($url), true);

      $album = Album::firstOrNew(['id' => $data['id']]);

      $album->fill($data);

      $album->save();

      foreach ($data['images'] as $image) {

        $newImage = Image::firstOrNew($image);

        $album->images()->save($newImage);
      }
      
      foreach ($data['artists'] as $artist) {

        unset($artist['external_urls']);

        $newArtist = Artist::firstOrNew($artist);

        $album->artists()->save($newArtist);
      }

      return $album;
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }
}
