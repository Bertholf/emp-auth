<?php

namespace App\Common\Models\Uptime\Traits\Relationship;

use App\Common\Models\Uptime\UptimeNotification;
use App\Common\Models\Uptime\UptimeLog;

trait UptimeRelationship
{
    /**
     * Gets all notifications associated with the site.
     *
     * @return Model
     */
    public function notifications()
    {
        return $this->hasMany(UptimeNotification::class);
    }

    /**
     * Get the sitelogs for this site.
     *
     * @return Model
     */
    public function siteLogs()
    {
        return $this->hasMany(UptimeLog::class);
    }
}
