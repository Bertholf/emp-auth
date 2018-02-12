<?php

namespace App\Common\Models\Course\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Course\Course;

/**
 * Class CourseRatingRelationship
 * @package App\Common\Models\Course\Traits\Relationship
 */
trait CourseRatingRelationship
{

    /**
     * A rating belongs to a course
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * A rating belongs to a User
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
