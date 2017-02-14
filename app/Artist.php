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

    public function external_url()
    {
      return $this->hasOne('App\ExternalURL', 'external_id', 'id');
    }
}
