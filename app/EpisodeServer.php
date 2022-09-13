<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpisodeServer extends Model
{

    protected $table = 'episode_server';

    protected $fillable = [
        'episode_id',
        'server_id',
        'embed_url'
    ];

    public function episode()
    {
        return $this->belongsToMany(Episode::class);
    }


}
