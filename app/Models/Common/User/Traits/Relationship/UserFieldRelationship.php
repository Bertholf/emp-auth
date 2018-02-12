<?php

namespace App\Models\Common\User\Traits\Relationship;

use App\Models\Common\User\Role;
use App\Models\Common\User\UserMeta;

/**
 * Class UserFieldRelationship
 * @package App\Models\Common\User\Traits\Relationship
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
