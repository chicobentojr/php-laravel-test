<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function artists()
    {
      return $this->belongsToMany('App\Artist', 'user_artists', 'user_id', 'artist_id');
    }

    public function albums()
    {
      return $this->belongsToMany('App\Album', 'user_albums', 'user_id', 'album_id');
    }

    public function tracks()
    {
      return $this->belongsToMany('App\Track', 'user_tracks', 'user_id', 'track_id');
    }
}
