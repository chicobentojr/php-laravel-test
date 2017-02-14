<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Image;
use App\ExternalURL;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Artist::all()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = 'https://api.spotify.com/v1/artists/0OdUWJ0sBjDrqHygGUXeCF';

        $data = json_decode(file_get_contents($url), true);

        $artist = new Artist;

        $artist = Artist::firstOrNew(['id' => $data['id']]);

        foreach ($data['images'] as $image) {

          $newImage = Image::firstOrNew($image);

          $artist->images()->save($newImage);
        }

        $key = key((array)$data['external_urls']);
        $value = current((array)$data['external_urls']);

        $external_url = ExternalURL::firstOrNew(['external_id' => $artist->id]);

        $artist->fill($data);

        $external_url->key = $key;
        $external_url->value = $value;

        $artist->save();
        $artist->external_url()->save($external_url);

        return $artist;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
