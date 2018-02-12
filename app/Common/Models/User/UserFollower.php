<?php

namespace App\Common\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserFollower
 * @package App\Common\Models
 * @version February 23, 2017, 5:30 am UTC
 */
class UserFollower extends Model
{
    // use SoftDeletes;

    public $table = 'users_followers';

    // protected $dates = ['deleted_at'];

    public $fillable = [
        'follower_id', 'leader_id', 'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'leader_id' => 'required|different:follower_id',
        'follower_id' => 'required|different:leader_id',
        'status' => 'required'
    ];
}
