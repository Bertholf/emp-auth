<?php

namespace App\Models\Common\Data;

use Illuminate\Database\Eloquent\Model;

class DataTechType extends Model
{
    protected $table = 'data_tech_types';

    protected $fillable = [
        'slug', 'description',
    ];
}
