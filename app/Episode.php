<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    protected $table = 'episodes';

    protected $fillable = ['series_id','seasons_id', 'name', 'background_cover', 'poster', 'url', 'api_url'];

    public function season2()
    {
        return $this->belongsTo(Seasons::class, 'seasons');
    }
    public function series()
    {
        return $this->belongsTo(Series::class, 'series');
    }

    public function getPosterAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getBackgroundCoverAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'episode_server');
    }
    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'series_category');
    // }

    // public function actors()
    // {
    //     return $this->belongsToMany(Actor::class, 'film_actor');
    // }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
