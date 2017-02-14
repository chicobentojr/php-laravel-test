<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
  public $primaryKey = 'track_id';

  protected $fillable = [
    'disc_number',
    'duration_ms',
    'explicit',
    'href',
    'is_playable',
    'name',
    'preview_url',
    'track_number',
    'id',
    'uri'
  ];

  public function artists()
  {
    return $this->belongsToMany('App\Artist', 'track_artists', 'track_id', 'artist_id');
  }

  public function users()
  {
    return $this->belongsToMany('App\User');
  }

  public function external_url()
  {
    return $this->hasOne('App\ExternalURL', 'external_id', 'id');
  }

  public static function getFromAPI($id)
  {
    $url = config('api.spotify.track').$id;
    $data = json_decode(file_get_contents($url), true);

    $track = Track::firstOrNew(['id' => $data['id']]);

    if (!$track->exists)
    {
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

      $external_url = ExternalURL::firstOrNew(['external_id' => $track->id]);
      $key = key((array)$data['external_urls']);
      $value = current((array)$data['external_urls']);
      $external_url->key = $key;
      $external_url->value = $value;

      $track->external_url()->save($external_url);
    }

    return $track;
  }
}
