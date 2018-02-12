<?php

namespace App\Common\Models\Assets\Traits\Relationship;

use App\Common\Models\Assets\AssetPlatform;

/**
 * Class AssetTypeRelationship
 * @package App\Common\Models\Assets\Traits\Relationship
 */
trait AssetTypeRelationship
{

    /**
     * Belongs to Parent
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->where('active', 1);
    }

    /**
     * Has Many Children
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->where('active', 1);
    }

    /**
     * A Asset Type has Platforms
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function platforms()
    {
        return $this->hasMany(AssetPlatform::class, 'type_id')->where('active', 1);
    }

    /**
     * A Asset Type has Platforms
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasManyThrough
     */
    public function childplatforms()
    {
        return $this->hasManyThrough(AssetPlatform::class, self::class, 'parent_id', 'type_id', 'id');
    }
}
