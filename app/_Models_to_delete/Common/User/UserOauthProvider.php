<?php

namespace App\Common\Models\User;

use App\Common\Models\User\Traits\UserOauthProviderTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOauthProvider extends Model
{
    use UserOauthProviderTraits,
        SoftDeletes;

    protected $table;

    protected $dates = ['deleted_at'];

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
        $this->table = config('emp-auth.auth.tables.user_oauth_providers_table');
        $this->connection = 'empauthable';
    }
}
