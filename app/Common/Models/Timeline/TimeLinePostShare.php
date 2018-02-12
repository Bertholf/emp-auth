<?php

namespace App\Common\Models\TimeLine;

use Illuminate\Database\Eloquent\Model;

class TimeLinePostShare extends Model
{
    protected $table = 'timelines_post_share';

    public function post()
    {
        return $this->belongsTo(TimelinePost::class, 'post_id', 'id');
    }
}
