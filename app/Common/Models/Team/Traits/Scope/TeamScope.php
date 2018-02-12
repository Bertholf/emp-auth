<?php

namespace App\Common\Models\Team\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class TeamScope
 * @package App\Common\Models\Team\Traits\Scope
 */
trait TeamScope
{

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeAllTeams(Builder $query)
    {
        return $query->withoutGlobalScope('teams');
    }
}
