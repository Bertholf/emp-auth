<?php

namespace App\Common\Events\Auth;

use App\Models\Common\User\User;
use Illuminate\Queue\SerializesModels;

class UserAuthSocialLinkedInLinked
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
