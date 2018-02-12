<?php

namespace App\Common\Models\User;

use App\Common\Models\User\Traits\Relationship\UserSettingRelationship;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use UserSettingRelationship;

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
    protected $fillable = [
        'user_id', 'privacy_comment', 'privacy_follow', 'privacy_post', 'privacy_follow_confirm', 'privacy_timeline_post', 'privacy_message', 'email_follow', 'email_post_like', 'email_post_share', 'email_comment_post', 'email_comment_like', 'email_comment_reply',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('actor.users_settings_table');
    }
}
