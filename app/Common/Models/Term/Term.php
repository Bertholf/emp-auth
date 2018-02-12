<?php

namespace App\Common\Models\Term;

use App\Common\Models\Term\Traits\Attribute\TermAttribute;
use App\Common\Models\Term\Traits\Relationship\TermRelationship;
use App\Common\Models\Term\Traits\Scope\TermScope;
use App\Common\Models\Timeline\Traits\Timelineable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use Translatable,
        Timelineable,
        TermRelationship,
        TermAttribute,
        TermScope;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The fields that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'text', 'stat_viewed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'similar',  'title', 'text', 'stat_viewed', 'active',
    ];

    /**
     * What is the primary route key
     *
     * @var string
     */
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
        $this->table = config('app-term.terms_table');
    }
}
