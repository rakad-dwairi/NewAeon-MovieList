<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    protected $table = 'episodes';

    protected $fillable = ['name'];

    public function season()
    {
        return $this->belongsTo(Seasons::class, 'seasons');
    }
    public function series()
    {
        return $this->belongsTo(Series::class, 'series');
    }

}
