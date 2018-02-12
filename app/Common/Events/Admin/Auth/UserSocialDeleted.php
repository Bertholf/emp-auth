<?php

namespace App\Common\Events\Admin\Auth;

use App\Models\Common\User\User;
use Illuminate\Queue\SerializesModels;

class UserSocialDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $social;

    /**
     * UserSocialDeleted constructor.
     *
     * @param $user
     * @param $social
     */
    public function __construct(User $user, $social)
    {
        $this->user = $user;
        $this->social = $social;
    }
}
