<?php

namespace App\Common\Events\Auth;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserInvitedToTeam
 * @package App\Events\Common\Team
 */
class UserInvitedToTeam
{
    use SerializesModels;

    /**
     * @type Model
     */
    protected $invite;

    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * @return Model
     */
    public function getInvite()
    {
        return $this->invite;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->invite->team_id;
    }
}
