<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $table = 'presentations';
    protected $primaryKey = 'presentation_id';

    public function comments()
    {
        return $this->belongsToMany('App\Comment', 'presentation_comments',
            'presentation_id', 'comment_id'
        );
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating', 'presentation_ratings',
            'presentation_id', 'rating_id'
        );
    }

    public function speakers()
    {
        return $this->hasManyThrough('App\Speaker', 'App\Pivots\PresentationSpeakers',
            'presentation_id', 'speaker_id', 'presentation_id', 'speaker_id'
        );
    }
}
