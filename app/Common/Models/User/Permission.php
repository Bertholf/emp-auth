<?php

namespace App\Common\Models\User;

use App\Common\Models\User\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Common\Models\User
 */
class Permission extends Model
{
    use PermissionRelationship;

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
    protected $fillable = ['slug', 'title', 'sort'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('actor.permissions_table');
    }
}
