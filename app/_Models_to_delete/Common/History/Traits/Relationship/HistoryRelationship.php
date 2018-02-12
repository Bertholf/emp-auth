<?php

namespace App\Common\Models\History\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\History\HistoryType;

/**
 * Class HistoryRelationship
 * @package App\Common\Models\History\Traits\Relationship
 */
trait HistoryRelationship
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(HistoryType::class, 'id', 'type_id');
    }
}
