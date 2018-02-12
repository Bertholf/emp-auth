<?php

namespace App\Common\Models\Course;

use App\Common\Models\Course\Traits\Relationship\CourseModuleLessonRelationship;
use App\Common\Models\Timeline\Traits\Timelineable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CourseModuleLesson extends Model
{
    use Translatable,
        Timelineable,
        CourseModuleLessonRelationship;

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
    public $translationForeignKey = 'lesson_id';

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
        'title', 'text', 'url_transcript', 'url_video', 'url_audio', 'url_slides'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_id', 'type', 'preview_available', 'length', 'order', 'course_id', 'title', 'text', 'url_transcript', 'url_video', 'url_audio', 'url_slides'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-course.courses_lessons_table');
    }
}
