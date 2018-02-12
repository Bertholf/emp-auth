<?php

namespace App\Common\Models\Course\Traits\Attribute;

use App\Common\Models\Course\CourseRating;

/**
 * Class CourseRatingAttribute
 * @package App\Common\Models\Course\Traits\Attribute
 */
trait CourseRatingAttribute
{

    /**
     * Get Course Rating by ID
     *
     * @var string
     */
    public static function rating($id)
    {
        return CourseRating::selectRaw('avg(rating) as rating, count(id) as count')->where('course_id', $id)->first();
    }
}
