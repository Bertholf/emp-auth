<?php

namespace App\Common\Models\Agency;

use App\Common\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
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
        'slug', 'title', 'text', 'whitelabel_logo', 'whitelabel_color_bg', 'url_public', 'url_cname', 'active'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('database.empire');
        $this->table = config('emp-ire.agencies_table');
    }

    /**
     * What is the primary route key
     *
     * @var string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
