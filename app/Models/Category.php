<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    /**
     * Get the articles in the category.
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
