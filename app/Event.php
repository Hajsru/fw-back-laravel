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


    public function speakers()
    {
        // https://medium.com/@DarkGhostHunter/laravel-has-many-through-pivot-elegantly-958dd096db
        return $this->hasManyThrough(
            'App\Speaker',           // The model to access to
            'App\Presentation',     // The intermediate table that connects the User with the Podcast.
            'event_id',             // The column of the intermediate table that connects to this model by its ID.
            'speaker_id',         // The column of the intermediate table that connects the Podcast by its ID.
            'event_id',             // The column that connects this model with the intermediate model table.
            'presentation_id' // The column of the Audio Files table that ties it to the Podcast.
        );

    }

    public function presentations()
    {
        return $this->hasMany(
            'App\Presentation',
            'event_id',
            'event_id'
        )->select((['*', \DB::raw('array_to_json(presentations.images) as images_array')]));

    }
}
