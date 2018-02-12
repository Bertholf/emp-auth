<?php

namespace App\Common\Models\Assets\Traits\Relationship;

use App\Common\Models\Team\TeamAssetPlatform;
use App\Common\Models\Assets\AssetType;

/**
 * Class AssetPlatformRelationship
 * @package App\Common\Models\Assets\Traits\Relationship
 */
trait AssetPlatformRelationship
{

    /**
     * A platform has a type
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(AssetType::class, 'type_id')->where('active', 1);
    }

    /**
     * A platform has ONE type based on active team
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasOne
     */
    public function team_asset_platform()
    {
        return $this->hasOne(TeamAssetPlatform::class, 'platform_id')->where('team_id', auth()->user()->currentTeam->id);
    }
}
