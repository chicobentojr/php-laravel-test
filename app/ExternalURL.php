<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalURL extends Model
{
    //]

    public function artist()
    {
      return $this->belongsTo('App\Artist', 'artist_id', 'artist_id');
    }
}
