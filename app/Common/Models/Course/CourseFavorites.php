<?php

namespace App\Common\Models\Course;

use App\Common\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class CourseFavorites extends Model
{
    protected $table = 'app_courses_favorites';

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
