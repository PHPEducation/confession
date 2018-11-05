<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'posts';

    /**
     * [$dates description]
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'user_id',
        'topic_id',
        'title',
        'slug',
        'body',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get images: One to many
     * @return [type] [description]
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'post_id');
    }

    /**
     * Get reports: One to many
     * @return [type] [description]
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'post_id');
    }

    /**
     * Get comments: One to many
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    /**
     * Get topics: One to many
     * @return [type] [description]
     */
    public function topics()
    {
        return $this->belongsTo('App\Models\Topic', 'post_id');
    }

    /**
     * Get users: One to many
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
