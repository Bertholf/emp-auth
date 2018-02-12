<?php

namespace App\Common\Models\Team\Traits\Relationship;

use App\Common\Models\Team\Team;

/**
 * Class TeamConnectRelationship
 * @package App\Common\Models\Team\Traits\Relationship
 */
trait TeamConnectRelationship
{
    /**
     * Has-One relations with the team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
