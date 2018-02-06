<?php

namespace App\Models\Common\User;

use App\Models\Common\User\Traits\UserTraits;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,
        UserTraits,
        Notifiable;

    /**
     * Protected Values
     *
     * @var string
     */
    protected $connection;
    protected $table;
    protected $oauthFields = [];
    protected $dates = ['deleted_at'];
    protected $access_token;
    protected $registered;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_first' => 'required',
        'name_last' => 'required',
        'name_slug' => 'required|unique:users,name_slug',
        'email' => 'required|unique:users,email',
        'password' => 'required|confirmed'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_first', 'name_last', 'name_slug', 'name_display',
        'email', 'password', 'status', 'confirmation_code', 'confirmed', 'verified',
        'current_team_id', 'referring_user_id',
        'language', 'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code', 'access_token'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('common.profile.tables.users_table');
        $this->connection = 'empauthable';
    }

}
