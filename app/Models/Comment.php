<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'user_id', 'article_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
