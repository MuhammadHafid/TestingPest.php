<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id', 'category_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
