<?php

namespace App\Common\Models\User\Traits\Relationship;

use App\Common\Models\User\User;

/**
 * Class UserSettingRelationship
 * @package App\Common\Models\User\Traits\Relationship
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
