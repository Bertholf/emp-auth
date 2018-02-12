<?php

namespace App\Common\Models\Team;

use App\Common\Models\Team\Traits\Relationship\TeamAssetPlatformRelationship;
use Illuminate\Database\Eloquent\Model;

class TeamAssetPlatform extends Model
{
    use TeamAssetPlatformRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['team_id', 'platform_id', 'status_claimed', 'status_linked', 'status_checked_at', 'url', 'meta', 'access_login', 'access_pass'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [ ])
    {
        parent::__construct($attributes);
        $this->table = config('app-assets.teams_assets_platforms_table');
    }
}
