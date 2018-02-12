<?php

namespace App\Common\Models\Timeline\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Timeline\TimelinePost;

/**
 * Class TimelineRelationship
 * @package App\Common\Models\Timeline\Traits\Relationship
 */
trait TimelineRelationship
{
    /**
     * Get all of the owning commentable models.
     */
    public function timelineable()
    {
        return $this->morphTo();
    }

    /**
     * May have a user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'timeline_id');
    }

    /**
     * Has-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(TimelinePost::class)->orderBy('created_at', 'desc');
    }
}
