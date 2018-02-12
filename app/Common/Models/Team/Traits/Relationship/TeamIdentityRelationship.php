<?php

namespace App\Common\Models\Team\Traits\Relationship;

use App\Common\Models\Team\Team;

/**
 * Class TeamIdentityRelationship
 * @package App\Common\Models\Team\Traits\Relationship
 */
trait TeamIdentityRelationship
{
    /**
     * Identity belongs to a Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
