<?php

namespace App\Models\Common\User\Traits\Scope;

/**
 * Class UserScope
 * @package App\Models\Common\User\Traits\Scope
 */
trait UserScope
{

    /**
     * @param $query
     * @param bool $confirmed
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        return $query->where('confirmed', $confirmed);
    }

    /**
     * @param $query
     * @param bool $status
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('status', $status);
    }


    public function scopeFollowersApproved($query)
    {
        return $query->with(['followers' => function ($q) {
                    $q->where(config('social-network.users_followers_table').'.status', 'approved');
                    $q->get()->count();
        }]);
    }

    public function scopeFollowersPending($query, $categoryId)
    {
        return $query->with(['followers' => function ($q) {
                    $q->where(config('social-network.users_followers_table').'.status', 'pending');
                    $q->get()->count();
        }]);
    }
}
