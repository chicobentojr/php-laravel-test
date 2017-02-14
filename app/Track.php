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
}
