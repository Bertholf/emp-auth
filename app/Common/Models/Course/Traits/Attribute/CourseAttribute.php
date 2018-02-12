<?php

namespace App\Common\Models\Course\Traits\Attribute;

/**
 * Class CourseAttribute
 * @package App\Common\Models\Course\Traits\Attribute
 */
trait CourseAttribute
{

    /**
     *
     * @return mix
     */
    public function averageRating()
    {
        return $this->ratings()
            ->selectRaw('AVG(rating) as averageRating')
            ->value('averageRating');
    }

    /**
     *
     * @return mix
     */
    public function countRatings()
    {
        return $this->ratings()
            ->selectRaw('COUNT(rating) as countRatings')
            ->value('countRatings');
    }

    /**
     *
     * @return mix
     */
    public function sumRating()
    {
        return $this->ratings()
            ->selectRaw('SUM(rating) as sumRating')
            ->value('sumRating');
    }
}
