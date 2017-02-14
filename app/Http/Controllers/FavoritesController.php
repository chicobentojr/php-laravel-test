<?php

namespace App\Http\Controllers;

use App\Track;
use App\Artist;
use App\ExternalURL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {

      return view('favorites.index', ['tracks' => Auth::user()->tracks()->get()]);
    }

    public function newTrack($id)
    {

      $url = 'https://api.spotify.com/v1/tracks/'.$id;

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

      $user = Auth::user();

      if (!$user->tracks()->get()->contains($track->track_id)) {
        $user->tracks()->save($track);
      }


      return $this->index();
    }
}
