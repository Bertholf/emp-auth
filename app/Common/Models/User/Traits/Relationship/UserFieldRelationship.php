<?php

namespace App\Common\Models\User\Traits\Relationship;

use App\Common\Models\User\Role;
use App\Common\Models\User\UserMeta;

/**
 * Class UserFieldRelationship
 * @package App\Common\Models\User\Traits\Relationship
 */
trait UserFieldRelationship
{
    /**
     * A User Custom Field type belongs to a Role
     *
     * @return mixed
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Has one meta value for current user
     * @return mixed
     */
    public function meta()
    {
        return $this->hasOne(UserMeta::class, 'field_id');
    }
}
