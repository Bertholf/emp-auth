<?php

namespace App\Models\Common\User;

use App\Models\Common\User\Traits\Attribute\RoleAttribute;
use App\Models\Common\User\Traits\Relationship\RoleRelationship;
use App\Models\Common\User\Traits\RoleAccess;
use App\Models\Common\User\Traits\Scope\RoleScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models\Common\User
 */
class Role extends Model
{
    use RoleScope,
        RoleAccess,
        RoleAttribute,
        RoleRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'title', 'text', 'icon', 'all', 'autoassign', 'visibility', 'self_opt_in', 'self_opt_out', 'show_on_registration', 'show_on_settings', 'active', 'order'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('actor.roles_table');
    }
}
