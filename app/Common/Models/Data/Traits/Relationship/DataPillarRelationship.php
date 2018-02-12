<?php

namespace App\Common\Models\Data\Traits\Relationship;

use App\Common\Models\Data\DataFactor;

/**
 * Class DataGoalRelationship
 * @package App\Common\Models\Data\Traits\Relationship
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
