<?php

namespace App\Models\Common\User\Traits\Relationship;

use App\Models\Common\User\User;
use App\Models\Common\User\UserField;

/**
 * Class UserMetaRelationship
 * @package App\Models\Common\User\Traits\Relationship
 */
trait UserMetaRelationship
{
    /**
     * User Meta belongs to a User
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User Meta is associated to a custom field
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function field()
    {
        return $this->belongsTo(UserField::class, 'field_id');
    }
}
