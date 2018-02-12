<?php

namespace App\Common\Events\Auth;

use App\Common\Models\User\User;
use Illuminate\Queue\SerializesModels;

class UserAuthSocialGoogleLinked
{
    use SerializesModels;

    /**
     * @var $user
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
