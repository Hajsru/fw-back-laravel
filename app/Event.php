<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';

    public function comments()
    {
        return $this->belongsToMany('App\Comment', 'event_comments',
            'event_id', 'comment_id'
        );
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating', 'event_ratings',
            'event_id', 'rating_id'
        );
    }
}
