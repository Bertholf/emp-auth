<?php

namespace App\Common\Models\Audit\Traits\Relationship;

use App\Common\Models\Data\DataFactor;

/**
 * Class AuditReportDataRelationship
 * @package App\Common\Models\Audit\Traits\Relationship
 */
trait AuditReportDataRelationship
{

    /**
     * Audit Data has parent Audit Factor
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function factor()
    {
        return $this->belongsTo(DataFactor::class, 'factor_id');
    }
}
