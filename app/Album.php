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
}
