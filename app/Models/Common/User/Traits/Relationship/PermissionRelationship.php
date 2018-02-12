<?php

namespace App\Models\Common\User\Traits\Relationship;

/**
 * Class PermissionRelationship
 * @package App\Models\Common\User\Traits\Relationship
 */
trait PermissionRelationship
{
    /**
     * A role may be assigned to multiple users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('actor.role'), config('actor.permission_role_table'), 'permission_id', 'role_id');
    }
}
