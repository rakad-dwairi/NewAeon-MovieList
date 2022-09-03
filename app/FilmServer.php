<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmServer extends Model
{

    protected $table = 'film_server';

    protected $fillable = [
        'film_id',
        'server_id',
        'embed_url'
    ];



}
