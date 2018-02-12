<?php

namespace App\Common\Models\Site\Traits\Relationship;

use App\Common\Models\Site\Site;

trait SiteScoreRelationship
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
