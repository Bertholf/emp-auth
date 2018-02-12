<?php

namespace App\Common\Models\Answers\Traits\Relationship;

use App\Common\Models\Answers\AnswersTopics;

/**
 * Class AnswersRelationship
 * @package App\Common\Models\Answers\Traits\Relationship
 */
trait AnswersRelationship
{

    /**
     * An Answer belongs to a Topic
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function topics()
    {
        return $this->belongsTo(AnswersTopics::class, 'topic_id', 'id');
    }
}
