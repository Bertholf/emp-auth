<?php

namespace App\Common\Models\Data\Traits\Relationship;

use App\Common\Models\Audit\AuditPricing;
use App\Common\Models\Course\Course;
use App\Common\Models\Term\Term;
use App\Common\Models\Article\Article;
use App\Common\Models\Data\DataFactor;

/**
 * Class DataTopicRelationship
 * @package App\Common\Models\Data\Traits\Relationship
 */
trait DataTopicRelationship
{

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->withCount('terms')->withCount('courses');
    }

    // AUDIT

    /**
     * A topic has packages
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function pricing()
    {
        return $this->hasMany(AuditPricing::class, 'topic_id', 'id')->translated();
    }


    // TERMS

    /**
     * A topic has many terms
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function terms()
    {
        return $this->belongsToMany(Term::class, config('app-term.terms_topics_mux_table'), 'term_id', 'topic_id');
    }


    // COURSES

    /**
     * A topic has many terms
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'app_courses_topics_mux', 'course_id', 'topic_id');
    }

    // SERVICES

    /**
     * A topic has many terms
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(\App\Common\Models\Service\Service::class, 'services_topics_mux', 'topic_id');
    }

    // ARTICLES

    /**
     * A topic has many posts
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'topic_id', 'id')->where('type', 'post');
    }

    public function factors()
    {
        return $this->hasMany(DataFactor::class, 'topic_id', 'id');
    }
}
