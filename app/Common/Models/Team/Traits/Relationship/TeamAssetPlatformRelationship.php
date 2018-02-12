<?php

namespace App\Common\Models\Team\Traits\Relationship;

use App\Common\Models\Team\Team;
use App\Common\Models\Assets\AssetPlatform;
use App\Common\Models\Assets\AssetType;

/**
 * Class TeamAssetPlatformRelationship
 * @package App\Common\Models\Team\Traits\Relationship
 */
trait TeamAssetPlatformRelationship
{
    /**
     * Team Asset Platform belongs to a Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'id', 'team_id');
    }

    /**
     * Team Asset Platform belongs to a Topic via Platform
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->hasManyThrough(AssetPlatform::class, AssetType::class, 'id', 'type_id', 'platform_id')->where(config('app-assets.assets_types_table').'.active', 1);
    }
}
