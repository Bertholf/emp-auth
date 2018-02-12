<?php

namespace App\Common\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserNotificationToken
 * @package App\Models
 * @version February 21, 2017, 12:53 pm UTC
 */
class UserNotificationToken extends Model
{
    public $table = 'users_notification_token';

    public $fillable = [
        'user_id',
        'token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'token' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
