<?php

namespace App\Models\Common\User\Traits\Relationship;

use App\Models\Common\User\Role;
use App\Models\Common\User\SocialLogin;
use App\Models\Common\User\User;
use App\Models\Common\User\UserMeta;
use App\Models\Common\User\UserSetting;
use App\Models\App\Timeline\TimelinePost;

/**
 * Class UserRelationship
 * @package App\Models\Common\User\Traits\Relationship
 */
trait UserRelationship
{

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, config('actor.assigned_roles_table'), 'user_id', 'role_id');
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }


    /**
     * User has many meta fields
     *
     * @return mixed
     */
    public function meta()
    {
        return $this->hasMany(UserMeta::class);
    }

    /**
     * Every user has one settings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function settings()
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    /**
     * User has many social logins
     *
     * @return mixed
     */
    public function social()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function hasSocialLinked($service)
    {
        return (bool) $this->social->where('service', $service)->count();
    }

    public function notificationToken()
    {
        return $this->hasOne(UserNotificationToken::class, 'user_id');
    }

    public function changeEmailToken()
    {
        return $this->hasOne(ChangeEmailToken::class, 'user_id');
    }


    /**
     * Social Networking
     *
     * (enable/disable in config('social-network.enable_following'))
     */


    /**
     * Users may make multiple comments on Timeline>Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(TimelinePost::class);
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, config('social-network.users_followers_table'), 'leader_id', 'follower_id')->withPivot('status as friend_status');
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, config('social-network.users_followers_table'), 'follower_id', 'leader_id');
    }
}
