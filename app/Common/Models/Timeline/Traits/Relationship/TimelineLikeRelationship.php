<?php

namespace App\Common\Models\Timeline\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Timeline\TimelinePost;

/**
 * Class TimelineLikesRelationship
 * @package App\Common\Models\Timeline\Traits\Relationship
 */
trait TimelineLikeRelationship
{

    /**
     * BelongsTo relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getNameSlugAttribute()
    {
        $user = $this->user;

        return $user->name_slug;
    }

    /**
     * BelongsTo a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(TimelinePost::class, 'post_id', 'id');
    }
}
