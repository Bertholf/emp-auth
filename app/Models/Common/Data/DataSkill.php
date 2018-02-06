<?php

namespace App\Models\Common\Data;

use App\Models\Actor\User\User;
use App\Models\Empire\Service\Service;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DataSkill
 * @package App\Models\Common\Data
 */
class DataSkill extends Model
{
    use Translatable;

    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Foreign key for the translation relationship
     *
     * @var string
     */
    public $translationForeignKey = 'data_id';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The fields that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'title_service', 'text',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'icon', 'order', 'active', 'title', 'text', 'title_service',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('database.default');
        $this->table = config('data.data_skills_table');
    }

    // @TODO Refactor as Trait
    public function services()
    {
        return $this->hasMany(Service::class, 'data_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
