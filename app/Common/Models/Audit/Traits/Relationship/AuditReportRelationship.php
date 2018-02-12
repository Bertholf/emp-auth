<?php

namespace App\Common\Models\Audit\Traits\Relationship;

use App\Common\Models\Team\Team;
use App\Common\Models\Audit\AuditReportData;
use App\Common\Models\Data\DataTopic;

/**
 * Class AuditReportRelationship
 * @package App\Common\Models\Audit\Traits\Relationship
 */
trait AuditReportRelationship
{

    /**
     * Audit Report is in a Topics (e.g. Social, Search, etc.)
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(DataTopic::class, 'topic_id');
    }

    /**
     * Audit Report is in a Topics (e.g. Social, Search, etc.)
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Audit Report has many Data Points
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function datas()
    {
        return $this->hasMany(AuditReportData::class, 'report_id')->with('factor');
    }
}
