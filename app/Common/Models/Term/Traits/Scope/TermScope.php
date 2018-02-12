<?php

namespace App\Common\Models\Term\Traits\Scope;

/**
 * Class TermScope
 * @package App\Common\Models\Term\Traits\Scope
 */
trait TermScope
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
