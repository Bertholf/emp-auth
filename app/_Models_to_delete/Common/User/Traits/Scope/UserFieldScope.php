<?php

namespace App\Common\Models\User\Traits\Scope;

/**
 * Class UserField
 * @package App\Common\Models\User\Traits\Scope
 */
trait UserFieldScope
{

    public function scopeWithMeta($query, $userId)
    {
        return $query->with(['meta' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }]);
    }
}
