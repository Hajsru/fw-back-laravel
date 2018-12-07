<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $table = 'presentations';
    protected $primaryKey = 'presentation_id';
    protected $appends = ['images_array'];


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

    public function setImagesArrayAttribute()
    {
        return DB::raw("array_to_json(presentations.images) as images_array");
    }
}
