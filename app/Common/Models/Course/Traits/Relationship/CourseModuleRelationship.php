<?php

namespace App\Common\Models\Course\Traits\Relationship;

use App\Common\Models\Course\Course;
use App\Common\Models\Course\CourseModuleLesson;

/**
 * Class CourseModuleRelationship
 * @package App\Common\Models\Course\Traits\Relationship
 */
trait CourseModuleRelationship
{

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->withCount('lessons');
    }

    /**
     * A section belongs to a course
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')->orderBy('slug');
    }

    /**
     * A section has many lessons
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function lessons()
    {
        return $this->hasMany(CourseModuleLesson::class, 'module_id', 'id')->orderBy('order');
    }
}
