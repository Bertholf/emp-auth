<?php

namespace App\Common\Events\Admin\Auth;

use App\Models\Common\Role\Role;
use Illuminate\Queue\SerializesModels;

class RoleCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $role;

    /**
     * @param $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
