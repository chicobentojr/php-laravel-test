<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalURL extends Model
{
    protected $fillable = [
      'key',
      'value',
      'external_id'
    ];

    public function artist()
    {
      return $this->belongsTo('App\Artist', 'id', 'external_id');
    }

    public function album()
    {
      return $this->belongsTo('App\Album', 'id', 'external_id');
    }

    public function track()
    {
      return $this->belongsTo('App\Track', 'id', 'external_id');
    }
}
