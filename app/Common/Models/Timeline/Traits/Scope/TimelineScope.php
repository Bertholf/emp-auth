<?php

namespace App\Common\Models\Timeline\Traits\Scope;

/**
 * Class TimelineScope
 * @package App\Common\Models\Timeline\Traits\Scope
 */
trait TimelineScope
{

    /**
     * @param $query
     * @param string $direction
     * @return mixed
     */
    public function scopeUsers($query)
    {
        return $query->where('timelineable_type', 'user');
    }
}
