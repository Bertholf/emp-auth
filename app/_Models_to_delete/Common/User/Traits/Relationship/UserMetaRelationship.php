<?php

namespace App\Common\Models\User\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\User\UserField;

/**
 * Class UserMetaRelationship
 * @package App\Common\Models\User\Traits\Relationship
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
