<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{

    protected $table = 'servers';

    protected $fillable = [
        'name',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_server');
    }

    public function episode()
    {
        return $this->belongsToMany(Episode::class, 'episode_server');
    }

}
