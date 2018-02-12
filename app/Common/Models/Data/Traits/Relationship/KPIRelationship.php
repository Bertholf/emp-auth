<?php

namespace App\Common\Models\Data\Traits\Relationship;

use App\Common\Models\Data\KPI;

trait KPIRelationship
{
    public function recommends()
    {
        return $this->belongsToMany(KPI::class, 'data_recommendations_kpis');
    }
}
