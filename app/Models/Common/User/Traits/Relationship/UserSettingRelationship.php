<?php

namespace App\Models\Common\User\Traits\Relationship;

use App\Models\Common\User\User;

/**
 * Class UserSettingRelationship
 * @package App\Models\Common\User\Traits\Relationship
 */
trait UserSettingRelationship
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
}
