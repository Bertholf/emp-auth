<?php

namespace App\Common\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Data\Traits\Relationship\KPIRelationship;

class KPI extends Model
{
    use KPIRelationship;

    protected $table = "kpis";

    protected $fillable = ['title'];
}
