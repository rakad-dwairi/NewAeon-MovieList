<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{

    protected $table = 'seasons';

    protected $fillable = ['name','no_episodes'];

    public function series()
    {
        return $this->belongsTo(Series::class, 'series');
    }


    public function episodes2()
    {
        return $this->hasMany(Episode::class);
    }

}
