<?php

namespace App\Common\Models\Course\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Course\CourseModuleLesson;

/**
 * Class CourseProgressRelationship
 * @package App\Common\Models\Course\Traits\Relationship
 */
trait CourseProgressRelationship
{

    /**
     * A rating belongs to a course
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo(CourseModuleLesson::class, 'course_lessons_id', 'id');
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
