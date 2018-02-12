<?php

namespace App\Common\Models\Team\Traits\Relationship;

use App\Common\Models\Team\Team;
use App\Common\Models\Team\TeamInvite;

/*
@TODO: TEST && RESTORE||REMOVE
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

use App\Events\Common\Team\UserJoinedTeam;
use App\Events\Common\Team\UserLeftTeam;
use App\Exceptions\Common\Team\UserNotInTeamException;
*/

/**
 * Class UserTeamRelationship
 * @package App\Common\Models\Team\Traits\Relationship
 */
trait UserTeamRelationship
{
    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, config('actor.team.users_teams_table'), 'user_id', 'team_id')->withTimestamps();
    }

    /**
     * has-one relation with the current selected team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentTeam()
    {
        return $this->hasOne(Team::class, 'id', 'current_team_id');
    }

    /**
     * @return mixed
     */
    public function ownedTeams()
    {
        return $this->teams()->where('owner_id', $this->getKey());
    }

    /**
     * One-to-Many relation with the invite model
     * @return mixed
     */
    public function invites()
    {
        return $this->hasMany(TeamInvite::class, 'email', 'email');
    }
}
