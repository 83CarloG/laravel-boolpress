<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Tag
 */
class Tag extends Model
{
    /**
     * posts
     *
     * @return void
     */
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
