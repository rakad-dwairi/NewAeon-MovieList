<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    protected $table = 'serie';

    protected $fillable = ['name'];

    public function episode()
    {
        return $this->belongsToMany(Series::class, 'series');
    }

}
