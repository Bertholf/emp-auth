<?php

namespace App\Common\Models\Course\Traits\Relationship;

use App\Common\Models\Course\CourseModule;
use App\Common\Models\Course\CourseProgress;
use App\Common\Models\Term\Term;

/**
 * Class CourseModuleLessonRelationship
 * @package App\Common\Models\Course\Traits\Relationship
 */
trait CourseModuleLessonRelationship
{

    /**
     * A section belongs to a course
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'module_id', 'id');
    }

    /**
     * A lesson has many terms
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function terms()
    {
        return $this->belongsToMany(Term::class, config('app-term.terms_lessons_mux_table'), 'lesson_id', 'term_id');
    }

    /**
     * A lesson has one progress (per active user)
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasOne
     */
    public function progress()
    {
        return $this->hasOne(CourseProgress::class, 'course_lessons_id')->where('user_id', auth()->user()->id);
    }
}
