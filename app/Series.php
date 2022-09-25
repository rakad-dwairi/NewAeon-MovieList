<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Series extends Model
{

    use favoritable, rateable, reviewable;

    protected $table = 'series';

    protected $fillable = ['name','seasons', 'year', 'overview', 'background_cover', 'poster'];

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

    public function type()
    {
        return $this->belongsToMany(Type::class, 'series_type');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'series_actor');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function seasons2()
    {
        return $this->hasMany(Seasons::class);
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
