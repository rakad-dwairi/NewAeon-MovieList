<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Series extends Model
{

    use favoritable, rateable, reviewable;

    protected $table = 'series';

    protected $fillable = ['name','seasons', 'year', 'overview', 'background_cover', 'poster', 'url', 'api_url'];

    protected static function booted()
    {
        static::deleting(function (Series $series) {
            $attributes = $series->getAttributes();
            Storage::delete($attributes['background_cover']);
            Storage::delete($attributes['poster']);
        });
    }

    public function getPosterAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getBackgroundCoverAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'series_category');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor');
    }

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
