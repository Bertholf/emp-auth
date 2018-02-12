<?php

namespace App\Common\Models\User\Traits\Attribute;

/**
 * Class UserAttribute
 * @package App\Common\Models\User\Traits\Attribute
 */
trait UserAttribute
{

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->name_last ? sprintf("%s %s", $this->name_first, $this->name_last) : $this->name_first;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        // @TODO: Refactor to check settings and show display name instead where applicable.
        return $this->name_last ? sprintf("%s %s", $this->name_first, $this->name_last) : $this->name_first;
    }

    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('actor.users.change_email');
    }

    /**
     * @return bool
     */
    public function hasPassword()
    {
        // Check if a password is set, if registered via SSO will be null
        if ($this->password == null || $this->password == '') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        // If registered via social should they be required to set a password?
        return config('actor.users.change_password_if_null');
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('common.general.active')."</label>";
        }

        return "<label class='label label-danger'>".trans('common.general.inactive')."</label>";
    }

    /**
     * @return string
     */
    public function getConfirmedLabelAttribute()
    {
        if ($this->isConfirmed()) {
            return "<label class='label label-success'>".trans('common.general.yes')."</label>";
        }

        return "<label class='label label-danger'>".trans('common.general.no')."</label>";
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }

    /**
     * @return bool
     */
    public function hasPicture()
    {
        // Check if image is specified
        if ($this->img_avatar) {
            return true;
        }
    }

    /**
     * @param bool $size
     * @return mixed
     */
    public function getPicture($size = false)
    {
        // Check if image is specified
        if ($this->img_avatar) {
            return asset('storage/' . $this->img_avatar);
        }

        // Gravatar fallback
        if (! $size) {
            $size = config('gravatar.default.size');
        }
        if ($this->email) {
            return gravatar()->get($this->email, ['size' => $size]);
        } else {
            dd($this);
        }
    }

    /**
     * @param $provider
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $provider
     * @return string
     */
    public function getPictureFromProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return $p->avatar;
            }
        }
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified == 1;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed == 1;
    }



    /**
     * @return bool
     */
    public function isFollowing($leader_id)
    {
        $respond = $this->following()->select(config('social-network.users_followers_table') .'.status')->where('leader_id', $leader_id)->first();
        if (!$respond) {
            return 'no';
        } else {
            return $respond->status;
        }
    }

    /**
     * @return bool
     */
    public function isFollowedBy($follower_id)
    {
        $respond = $this->following()->select(config('social-network.users_followers_table') .'.status')->where('follower_id', $follower_id)->first();
        if (!$respond) {
            return 'no';
        } else {
            return $respond->status;
        }
    }
}
