<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmType extends Model
{

    protected $table = 'film_type';

    protected $fillable = [
        'film_id',
        'type_id',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

}