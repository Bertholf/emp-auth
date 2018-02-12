<?php

namespace App\Common\Models\Site;

use Illuminate\Database\Eloquent\Model;

class SiteUrl extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'site_urls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'site_id', 'path',
    ];
}
