<?php
namespace App\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PresentationSpeakers extends Pivot {

    protected $table = 'presentation_speakers';

    public function presentation()
    {
        return $this->hasMany('App\Presentation', 'presentation_id', 'presentation_id');
    }

    public function speaker()
    {
        return $this->hasMany('App\Speaker', 'speaker_id', 'speaker_id');
    }

    public function event()
    {
        return $this->hasManyThrough('App\Events', 'App\Presentation', 'event_id', 'presentation_id');
    }

}
