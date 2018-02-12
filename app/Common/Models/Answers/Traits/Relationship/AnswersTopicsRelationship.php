<?php

namespace App\Common\Models\Answers\Traits\Relationship;

use App\Common\Models\Answers\Answers;

/**
 * Class AnswersTopicsRelationship
 * @package App\Common\Models\Answers\Traits\Relationship
 */
trait AnswersTopicsRelationship
{

    /**
     * An question belongs to an Answer Topic
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Answers::class, 'topic_id');
    }
}
