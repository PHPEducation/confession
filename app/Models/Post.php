<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'post_id');
    }

    /**
     * Lay bai post duoc like thoe user
     */
    public function liked($postId)
    {
        $liked = $this->likes()->where('post_id', $postId)->where('user_id', Auth::id())->first();

        return $liked != null ? true : false;
    }

    /**
     * Get reports: One to many
     * @return [type] [description]
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'post_id');
    }

    public function reported($postId)
    {
        $liked = $this->reports()->where('post_id', $postId)->where('user_id', Auth::id())->first();

        return $liked != null ? true : false;
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
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
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
