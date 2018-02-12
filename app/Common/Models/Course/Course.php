<?php

namespace App\Common\Models\Course;

use App\Common\Models\Course\Traits\Attribute\CourseAttribute;
use App\Common\Models\Course\Traits\Relationship\CourseRelationship;
use App\Common\Models\Course\Traits\Scope\CourseScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use Translatable,
        CourseRelationship,
        CourseAttribute,
        CourseScope;

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
        'title', 'text_short', 'text', 'url_image', 'url_video',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'slug', 'active', 'title', 'text_short', 'text', 'url_image', 'url_video', 'featured',
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
        $this->table = config('app-course.courses_table');
    }
}
