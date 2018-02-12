<?php

namespace App\Common\Models\Course;

use App\Common\Models\User\User;
use App\Common\Models\Course\Traits\Attribute\CourseRatingAttribute;
use App\Common\Models\Course\Traits\Relationship\CourseRatingRelationship;
use Illuminate\Database\Eloquent\Model;

class CourseRating extends Model
{
    use CourseRatingRelationship,
        CourseRatingAttribute;

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
        'course_id', 'user_id', 'rating', 'text',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-course.courses_ratings_table');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
