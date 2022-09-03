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

    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_server');
    }

}
