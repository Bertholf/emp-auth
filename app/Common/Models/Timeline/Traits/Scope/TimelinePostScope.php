<?php

namespace App\Common\Models\Timeline\Traits\Scope;

/**
 * Class TimelinePostScope
 * @package App\Common\Models\Timeline\Traits\Scope
 */
trait TimelinePostScope
{

    /**
     * @param $query
     * @param string $direction
     * @return mixed
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
