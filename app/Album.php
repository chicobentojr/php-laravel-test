<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $primaryKey = 'album_id';

    protected $fillable = [
      'href',
      'name',
      'type',
      'uri',
      'id',
      'album_type'
    ];

    public function artists()
    {
      return $this->belongsToMany('App\Artist', 'album_artists', 'album_id', 'artist_id');
    }

    public function images()
    {
      return $this->hasMany('App\Image', 'external_id', 'id');
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
      $url = config('api.spotify.album').$id;
      $data = json_decode(file_get_contents($url), true);

      $album = Album::firstOrNew(['id' => $data['id']]);

      if (!$album->exists)
      {
        $album->fill($data);
        $album->save();

        foreach ($data['images'] as $image) {
          $newImage = Image::firstOrNew($image);
          $album->images()->save($newImage);
        }

        foreach ($data['artists'] as $artist) {
          unset($artist['external_urls']);
          $newArtist = Artist::firstOrNew(['id' => $artist['id']]);

          if (!$newArtist->exists) {
            $newArtist->fill($artist);
            $album->artists()->save($newArtist);
          }
        }

        $external_url = ExternalURL::firstOrNew(['external_id' => $album->id]);
        $key = key((array)$data['external_urls']);
        $value = current((array)$data['external_urls']);
        $external_url->key = $key;
        $external_url->value = $value;


        $album->external_url()->save($external_url);
      }

      return $album;
    }
}
