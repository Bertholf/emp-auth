<?php

namespace App\Common\Models\Site\Traits\Relationship;

use App\Common\Models\Site\SiteAuditLogCheck;
use App\Common\Models\Site\Site;

trait SiteAuditLogRelationship
{

  /**
  * TODO
  */
    public function checks()
    {
        return $this->hasMany(SiteAuditLogCheck::class, 'audit_id');
    }

    /**
     * Related site
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
