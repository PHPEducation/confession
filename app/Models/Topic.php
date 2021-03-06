<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    use SoftDeletes;

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'topics';

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
        'name',
        'slug',
        'images',
        'set_time',
        'select_time',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
    ];

    /**
     * Get posts: One to many
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'topic_id');
    }

    /**
     * Get users: Many to many
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get all of the topic's follows.
     */
    public function follows()
    {
        return $this->morphMany('App\Models\Follow', 'follow');
    }

//    follow topic theo user
    public function followed($topicId)
    {
        $topiced = $this->follows()->where([
            'follow_id' => $topicId,
            'user_id' => Auth::id(),
            'follow_type' => 'App\Models\Topic',
        ])->first();

        return $topiced != null ? true : false;
    }
}
