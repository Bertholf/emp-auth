<?php

namespace App\Common\Models\Site\Traits\Relationship;

use App\Common\Models\Site\Site;
use App\Common\Models\Site\SiteAuditLog;

trait SiteAuditScheduleRelationship
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function logs()
    {
        return $this->morphMany(SiteAuditLog::class, 'auditor');
    }
}
