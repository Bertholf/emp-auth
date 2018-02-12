<?php

namespace App\Common\Events\Admin\Auth;

use App\Common\Models\User\User;
use Illuminate\Queue\SerializesModels;

class UserUnconfirmed
{
    use SerializesModels;

    /**
     * @var
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
