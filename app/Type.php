<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $table = 'type';

    protected $fillable = ['name'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_type');
    }

    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_type');
    }

}
