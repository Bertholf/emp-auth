<?php

namespace App\Common\Models\Team\Traits\Relationship;

use App\Common\Models\Team\Team;
use App\Common\Models\User\User;

/**
 * Class TeamInviteRelationship
 * @package App\Common\Models\Team\Traits\Relationship
 */
trait TeamInviteRelationship
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

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inviter()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
