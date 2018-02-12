<?php

namespace App\Models\Common\User\Traits;

use App\Notifications\Common\User\UserNeedsPasswordReset;

/**
 * Class UserSendPasswordReset
 * @package App\Models\Common\User\Traits
 */
trait UserSendPasswordReset
{
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserNeedsPasswordReset($token));
    }
}
