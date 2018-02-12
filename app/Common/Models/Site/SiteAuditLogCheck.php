<?php

namespace App\Common\Models\Site;

use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Site\Traits\Relationship\SiteAuditLogCheckRelationship;

class SiteAuditLogCheck extends Model
{
    use SiteAuditLogCheckRelationship;

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = ['checks'];

    protected $casts = [
        'notes' => 'json'
    ];
    protected $fillable = ['audit_id', 'check', 'title', 'status', 'started_at', 'completed_at', 'notes', ];
}
