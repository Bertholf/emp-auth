<?php

namespace App\Common\Models\Assets;

use App\Common\Models\Assets\Traits\Relationship\AssetTypeRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    use Translatable,
        AssetTypeRelationship;

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
    public $translationForeignKey = 'type_id';

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
        'title', 'text',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'icon', 'group_id', 'parent_id', 'title', 'text', 'active',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-assets.assets_types_table');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
