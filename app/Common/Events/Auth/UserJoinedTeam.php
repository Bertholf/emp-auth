<?php

namespace App\Events\Common\Team;

use App\Models\Common\User\User;
use Illuminate\Queue\SerializesModels;

class UserJoinedTeam
{
    use SerializesModels;

    /**
     * @type Model
     */
    protected $user;

    /**
     * @type int
     */
    protected $team_id;

    public function __construct(User $user, $team_id)
    {
        $this->user = $user;
        $this->team_id = $team_id;
    }

    /**
     * @return Model
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->team_id;
    }
}
