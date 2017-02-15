<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Album;
use App\Track;
use App\ExternalURL;
use App\Image;
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
      return view('favorites.index');
    }

    public function artists()
    {
      return view('favorites.artists', ['artists' => Auth::user()->artists()->orderBy('created_at','desc')->get()]);
    }

    public function albums()
    {
      return view('favorites.albums', ['albums' => Auth::user()->albums()->orderBy('created_at','desc')->get()]);
    }

    public function tracks()
    {
      return view('favorites.tracks', ['tracks' => Auth::user()->tracks()->orderBy('created_at','desc')->get()]);
    }

    public function saveArtist($id)
    {
      $artist = Artist::getFromAPI($id);
      $user = Auth::user();

      if (!$user->artists()->get()->contains($artist->artist_id)) {
        $user->artists()->save($artist);
      }

      return redirect()->route('favorites.artists');
    }

    public function saveAlbum($id)
    {
      $album = Album::getFromAPI($id);
      $user = Auth::user();

      if (!$user->albums()->get()->contains($album->album_id)) {
        $user->albums()->save($album);
      }

      return redirect()->route('favorites.albums');
    }

    public function saveTrack($id)
    {
      $track = Track::getFromAPI($id);
      $user = Auth::user();

      if (!$user->tracks()->get()->contains($track->track_id)) {
        $user->tracks()->save($track);
      }

      return redirect()->route('favorites.tracks');
    }
}
