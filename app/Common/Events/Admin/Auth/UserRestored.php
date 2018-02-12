<?php

namespace App\Common\Events\Admin\Auth;

use App\Models\Common\User\User;
use Illuminate\Queue\SerializesModels;

class UserRestored
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
