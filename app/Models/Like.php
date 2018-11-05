<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'likes';

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
        'post_id',
        'type',
        'created_at',
        'updated_at',
    ];

    /**
     * Get users: One to many
     * @return [type] [description]
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get posts: One to many
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
