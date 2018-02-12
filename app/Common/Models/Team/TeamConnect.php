<?php

namespace App\Common\Models\Team;

use App\Common\Models\Team\Traits\Relationship\TeamConnectRelationship;
use Illuminate\Database\Eloquent\Model;

class TeamConnect extends Model
{
    use TeamConnectRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['team_id', 'service', 'access_token', 'refresh_token', 'expires_in', 'token'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [ ])
    {
        parent::__construct($attributes);
        $this->table = config('actor.team.teams_connections_table');
    }
}
