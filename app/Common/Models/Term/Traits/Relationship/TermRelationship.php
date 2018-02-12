<?php

namespace App\Common\Models\Term\Traits\Relationship;

use App\Common\Models\Course\CourseModuleLesson;
use App\Common\Models\Term\TermExample;
use App\Common\Models\Data\DataTopic;

/**
 * Class TermRelationship
 * @package App\Common\Models\Term\Traits\Relationship
 */
trait TermRelationship
{

    /**
     * Get the the examples
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function examples()
    {
        return $this->hasMany(TermExample::class);
    }

    /**
     * A term has many topics
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(DataTopic::class, config('app-term.terms_topics_mux_table'), 'term_id', 'topic_id');
    }

    /**
     * A term has many lessons
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(CourseModuleLesson::class, config('app-term.terms_lessons_mux_table'), 'term_id', 'lesson_id')->with('module');
    }
}
