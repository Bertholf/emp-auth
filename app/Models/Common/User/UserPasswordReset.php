<?php

namespace App\Models\Common\User;

use App\Models\Common\User\Traits\UserPasswordResetTraits;
use Illuminate\Database\Eloquent\Model;

class UserPasswordReset extends Model
{
    use UserPasswordResetTraits;

    protected $table;

    public $fillable = [
        'user_id',
        'provider',
        'oauth_provider_id',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-auth.auth.tables.user_password_resets_table');
        $this->connection = 'empauthable';
    }

}
