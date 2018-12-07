<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $table = 'speakers';
    protected $primaryKey = 'speaker_id';

    public function comments()
    {
        return $this->belongsToMany('App\Comment', 'speaker_comments',
            'speaker_id', 'comment_id'
        );
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating', 'speaker_ratings',
            'speaker_id', 'rating_id'
        );
    }

    public function events()
    {
        return $this->belongsToMany('App\Event')->using('App\Pivots\PresentationSpeakers');
    }
}
