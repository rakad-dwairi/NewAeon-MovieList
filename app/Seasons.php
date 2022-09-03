<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{

    protected $table = 'seasons';

    protected $fillable = ['name','no_episodes','series_id','background_cover'];

    public function series()
    {
        return $this->belongsTo(Series::class, 'series');
    }


    public function episodes2()
    {
        return $this->hasMany(Episode::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'series_category');
    // }

    // public function actors()
    // {
    //     return $this->belongsToMany(Actor::class, 'series_actor');
    // }
    
}
