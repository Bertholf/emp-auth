<?php

namespace App\Common\Models\Uptime\Traits\Relationship;

use App\Common\Models\Site\Site;

trait UptimeNotificationRelationship
{
  /**
   * Get the user this site belongs to.
   *
   * @return
   */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
