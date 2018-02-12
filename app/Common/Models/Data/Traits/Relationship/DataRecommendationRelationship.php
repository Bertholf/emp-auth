<?php

namespace App\Common\Models\Data\Traits\Relationship;

use App\Common\Models\Data\KPI;

trait DataRecommendationRelationship
{
    public function kpis()
    {
        return $this->belongsToMany(KPI::class, config('emp-marketaing.data_recommendations_kpis_table'), 'recommend_id', 'kpi_id');
    }
}
