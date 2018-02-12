<?php

namespace App\Models\Common\User;

use App\Models\Common\Team\Traits\Attribute\UserTeamAttribute;
use App\Models\Common\Team\Traits\Relationship\UserTeamRelationship;
use App\Models\Common\User\Traits\Attribute\UserAttribute;
use App\Models\Common\User\Traits\Relationship\UserRelationship;
use App\Models\Common\User\Traits\Scope\UserScope;
use App\Models\Common\User\Traits\UserAccess;
use App\Models\Common\User\Traits\UserSendPasswordReset;
use App\Models\App\Messaging\Messagable;
use App\Models\App\Timeline\Traits\Timelineable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,
        SoftDeletes,
        UserScope,
        UserAccess,
        UserAttribute,
        UserTeamAttribute,
        UserRelationship,
        UserTeamRelationship,
        UserSendPasswordReset,
        Notifiable,
        Timelineable,
        Messagable;

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
        $this->table = config('emp-auth.profile.tables.users_table');
        $this->connection = 'empauthable';
    }


    // @TODO v @TODO v @TODO v @TODO v @TODO v @TODO v @TODO v @TODO
    // @TODO: Sort out & clean up


    public function setOauthFields($oauthFields)
    {
        $this->oauthFields = $oauthFields;
    }

    public function getOauthFields()
    {
        return $this->oauthFields;
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    // @TODO Describe
    public function findForPassport($username)
    {
        return self::where('name_slug', $username)->first(); // change column name whatever we use in credentials
    }





}
