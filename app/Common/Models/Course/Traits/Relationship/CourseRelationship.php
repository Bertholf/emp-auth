<?php

namespace App\Common\Models\Course\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Course\CourseFavorites;
use App\Common\Models\Course\CourseModule;
use App\Common\Models\Course\CourseModuleLesson;
use App\Common\Models\Course\CourseRating;
use App\Common\Models\Data\DataTopic;

/**
 * Class CourseRelationship
 * @package App\Common\Models\Course\Traits\Relationship
 */
trait CourseRelationship
{

    /**
     * A course has many topics
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(DataTopic::class, config('app-course.courses_topics_mux_table'), 'course_id', 'topic_id');
    }

    /**
     * A course has one instructor
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name_first', 'name_last', 'name_slug', 'email', 'img_avatar']);
    }

    /**
     * Get the the modules
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function modules()
    {
        return $this->hasMany(CourseModule::class)->where('parent_id', 0)->with('lessons');
    }

    /**
     * A course has many lessons inside modules
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasManyThrough
     */
    public function lessons()
    {
        return $this->hasManyThrough(CourseModuleLesson::class, CourseModule::class, 'course_id', 'module_id', 'id')->withCount('terms');
    }

    /**
     * Get all course ratings
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(CourseRating::class, 'course_id', 'id')->with('users');
    }

    public function favorites()
    {
        return $this->hasMany(CourseFavorites::class, 'course_id', 'id')->with('users');
    }
}
