<?php

namespace App\Models\Common\Data\Traits\Relationship;

use App\Models\Common\Data\DataGoal;

/**
 * Class DataKPIRelationship
 * @package App\Models\Common\Data\Traits\Relationship
 */
trait DataKPIRelationship
{

    /**
     * A KPI is related to a Goal
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsToMany
     */
    public function goals()
    {
        return $this->belongsToMany(DataGoal::class, config('data.data_goals_kpis_table'), 'kpi_id', 'goal_id')->withPivot('weight');
    }
}
