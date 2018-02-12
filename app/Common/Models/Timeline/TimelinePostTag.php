<?php

namespace App\Common\Models\TimeLine;

use Illuminate\Database\Eloquent\Model;

class TimelinePostTag extends Model
{
    protected $table = 'timelines_post_tag';

    protected $appends = ['profile_link'];

    public function getProfileLinkAttribute()
    {
        return route('actor.user.profile.show', $this->slug);
    }
}
