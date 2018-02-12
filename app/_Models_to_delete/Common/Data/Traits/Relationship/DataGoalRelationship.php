<?php

namespace App\Common\Models\Data\Traits\Relationship;

use App\Common\Models\Data\DataKPI;

/**
 * Class DataGoalRelationship
 * @package App\Common\Models\Data\Traits\Relationship
 */
trait DataGoalRelationship
{

    /**
     * A KPI is related to a Goal
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function kpis()
    {
        return $this->belongsToMany(DataKPI::class, config('data.data_goals_kpis_table'), 'goal_id', 'kpi_id');
    }
}
