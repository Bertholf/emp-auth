<?php

namespace App\Common\Events\Admin\Auth;

use App\Common\Models\Role\Role;
use Illuminate\Queue\SerializesModels;

class RoleUpdated
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
