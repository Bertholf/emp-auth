<?php

namespace App\Common\Models\Team;

use App\Common\Models\Team\Traits\Attribute\TeamAttribute;
use App\Common\Models\Team\Traits\Relationship\TeamRelationship;
use App\Common\Models\Team\Traits\Scope\TeamScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed domain
 * @mixin Model
 */
class Team extends Model
{
    use TeamRelationship,
        TeamAttribute,
        TeamScope;

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
    protected $fillable = ['name', 'owner_id', 'setup'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('actor.team.teams_table');
    }
}
