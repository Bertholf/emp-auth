<?php

namespace App\Models\Common\Data\Traits\Relationship;

use App\Models\Common\Data\DataFactor;

/**
 * Class DataGoalRelationship
 * @package App\Models\Common\Data\Traits\Relationship
 */
trait DataPillarRelationship
{

    /**
     * A KPI is related to a Goal
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function factor()
    {
        return $this->belongsToMany(DataFactor::class, config('data.data_pillar_factor_table'), 'pillar_id', 'factor_id');
    }
}
