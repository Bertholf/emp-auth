<?php

namespace App\Common\Models\Team;

use App\Common\Models\Team\Traits\Relationship\TeamIdentityRelationship;
use Illuminate\Database\Eloquent\Model;

class TeamIdentity extends Model
{
    use TeamIdentityRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are guarded
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [ ])
    {
        parent::__construct($attributes);
        $this->table = config('actor.team.teams_identity_table');
    }
}
