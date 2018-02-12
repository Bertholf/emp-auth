<?php

namespace App\Common\Models\Site\Traits\Relationship;

use App\Common\Models\Site\Site;
use App\Common\Models\Data\DataRecommendation;

trait SiteRecommendationRelationship
{

    /**
    * Gets all notifications associated with the site.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    /**
     * Gets all metrics associated with the site.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(DataRecommendation::class, 'recommendation_id');
    }
}
