<?php

namespace App\Common\Models\Audit\Traits\Relationship;

use App\Common\Models\Data\DataTopic;

/**
 * Class AuditPricingRelationship
 * @package App\Common\Models\Audit\Traits\Relationship
 */
trait AuditPricingRelationship
{

    /**
     * A Price belongs to a Topic
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(DataTopic::class, 'topic_id');
    }
}
