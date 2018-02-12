<?php

namespace App\Common\Models\Course;

use App\Common\Models\Course\Traits\Relationship\CourseProgressRelationship;
use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    use CourseProgressRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_lessons_id', 'user_id', 'progress', 'completed',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-course.courses_progress_table');
    }
}
