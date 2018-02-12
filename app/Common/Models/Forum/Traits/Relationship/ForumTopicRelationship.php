<?php

namespace App\Common\Models\Forum\Traits\Relationship;

/**
 * Class ForumTopicRelationship
 * @package App\Common\Models\Forum\Traits\Relationship
 */
trait ForumTopicRelationship
{

    /**
     * A section has many lessons
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function sub_topics()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
