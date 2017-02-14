<?php

namespace App\Http\Controllers;

use App\Track;
use App\Artist;
use App\ExternalURL;
use Illuminate\Http\Request;

class TrackController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      return Track::all();
  }

  public function create()
  {
    $url = 'https://api.spotify.com/v1/tracks/3n3Ppam7vgaVa1iaRUc9Lp';

    $data = json_decode(file_get_contents($url), true);

    $track = Track::firstOrNew(['id' => $data['id']]);

    $track->fill($data);

    $track->save();

    foreach ($data['artists'] as $artist) {

      unset($artist['external_urls']);

      $newArtist = Artist::firstOrNew(['id' => $artist['id']]);

      if (!$newArtist->exists) {

        $newArtist->fill($artist);

        $track->artists()->save($newArtist);
      }
    }

    $key = key((array)$data['external_urls']);
    $value = current((array)$data['external_urls']);

    $external_url = ExternalURL::firstOrNew(['external_id' => $track->id]);

    $external_url->key = $key;
    $external_url->value = $value;

    $track->external_url()->save($external_url);

    return $track;
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
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        //
    }
}
