<?php

namespace App\Common\Models\Course;

use App\Common\Models\Course\Traits\Relationship\CourseModuleRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use Translatable,
        CourseModuleRelationship;

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
    public $translationForeignKey = 'module_id';

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
        'slug', 'course_id', 'title', 'text', 'order',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-course.courses_modules_table');
    }
}
