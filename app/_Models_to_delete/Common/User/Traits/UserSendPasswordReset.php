<?php

namespace App\Common\Models\User\Traits;

use App\Notifications\Common\User\UserNeedsPasswordReset;

/**
 * Class UserSendPasswordReset
 * @package App\Common\Models\User\Traits
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
