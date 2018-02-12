<?php

namespace App\Common\Models\Site\Traits\Relationship;

use App\Common\Models\Site\SiteAuditLog;

trait SiteAuditLogCheckRelationship
{
    public function audit()
    {
        $this->belongsTo(SiteAuditLog::class, 'audit_id');
    }
}
