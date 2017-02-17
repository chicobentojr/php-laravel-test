<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumImages extends Model
{
  protected $fillable = [
    'width',
    'height',
    'url'
  ];

  public function album()
  {
    return $this->belongsTo('App\Album', 'album_id', 'album_id');
  }

  public function artist()
  {
    return $this->belongsTo('App\Artist', 'artist_id', 'artist_id');
  }
}
