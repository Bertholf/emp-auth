<?php

namespace App\Common\Models\Protocol\Traits\Relationship;

use App\Common\Models\Data\DataSkill;

/**
 * Class ProtocolRelationship
 * @package App\Common\Models\Protocol\Traits\Relationship
 */
trait ProtocolRelationship
{

    /**
     * A section belongs to a course
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function skill()
    {
        return $this->belongsTo(DataSkill::class, 'data_id', 'id');
    }
}
