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

    public function external_url()
    {
      return $this->hasOne('App\ExternalURL', 'artist_id', 'artist_id');
    }
}
