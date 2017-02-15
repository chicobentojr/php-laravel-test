<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public $primaryKey = 'artist_id';

    protected $fillable = [
      'href',
      'name',
      'type',
      'uri',
      'id'
    ];

    public function albums()
    {
      return $this->belongsToMany('App\Album');
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

    public static function getFromAPI($id, $persist = true)
    {
      $url = config('api.spotify.artist').$id;
      $data = json_decode(file_get_contents($url), true);

      $artist = new Artist;
      $artist = Artist::firstOrNew(['id' => $data['id']]);
      $artist->fill($data);
      
      if ($persist && !$artist->exists)
      {
        $artist->save();

        foreach ($data['images'] as $image) {
          $newImage = Image::firstOrNew($image);
          $artist->images()->save($newImage);
        }

        $external_url = ExternalURL::firstOrNew(['external_id' => $artist->id]);
        $key = key((array)$data['external_urls']);
        $value = current((array)$data['external_urls']);
        $external_url->key = $key;
        $external_url->value = $value;

        $artist->external_url()->save($external_url);
      }

      return $artist;
    }
}
