<?php

namespace App\Common\Models\Team\Traits\Relationship;

use App\Common\Models\Team\TeamAssetPlatform;
use App\Common\Models\Team\TeamConnect;
use App\Common\Models\Team\TeamIdentity;
use App\Common\Models\Team\TeamInvite;
use App\Common\Models\User\User;
use App\Common\Models\Site\Site;
use App\Common\Models\Data\DataGoal;
use App\Common\Models\Data\DataTech;

/**
 * Class TeamRelationship
 * @package App\Common\Models\Team\Traits\Relationship
 */
trait TeamRelationship
{

    /**
     * One-to-Many relation with the invite model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites()
    {
        return $this->hasMany(TeamInvite::class, 'team_id', 'id');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, config('actor.team.users_teams_table'), 'team_id', 'user_id')->withTimestamps();
    }

    /**
     * Has-One relation with the user model.
     * This indicates the owner of the team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    /**
     * Has-One relation with the user model.
     * This indicates the owner of the team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function identity()
    {
        return $this->hasOne(TeamIdentity::class, 'team_id');
    }

    /**
     * Has-One relation with the user model.
     * This indicates the owner of the team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function connections()
    {
        return $this->hasMany(TeamConnect::class, 'team_id');
    }

    /**
     * A Team has Goals
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function goals()
    {
        return $this->belongsToMany(DataGoal::class, config('actor.team.teams_data_goals_table'), 'team_id', 'goal_id')->withPivot('priority');
    }

    /**
     * A Team has Tech
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function tech()
    {
        return $this->belongsToMany(DataTech::class, config('actor.team.teams_data_tech_table'), 'team_id', 'tech_id')->withPivot('meta');
    }

    /**
     * Has many Asset Platforms (Social Buildout)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets_platforms()
    {
        return $this->hasMany(TeamAssetPlatform::class, 'team_id');
    }

    public function site()
    {
        return $this->hasOne(Site::class);
    }
}
