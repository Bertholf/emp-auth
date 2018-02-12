<?php

namespace App\Common\Models\Assets;

use App\Common\Models\Assets\Traits\Relationship\AssetPlatformRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AssetPlatform extends Model
{
    use Translatable,
        AssetPlatformRelationship;

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
    public $translationForeignKey = 'platform_id';

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
        'title', 'text', 'instructions',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level_id', 'type_id', 'slug', 'icon', 'url_register', 'config_login', 'config_pass', 'title', 'text', 'instructions',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-assets.assets_platform_table');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
