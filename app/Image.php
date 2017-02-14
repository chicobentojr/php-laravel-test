<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
      'width',
      'height',
      'url'
    ];

    public function album()
    {
      return $this->belongsTo('App\Album', 'id', 'external_id');
    }

    public function artist()
    {
      return $this->belongsTo('App\Artist', 'id', 'external_id');
    }
}
