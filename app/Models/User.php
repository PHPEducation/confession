<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nick_name',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'images',
        'created_at',
        'update_at',
        'delete_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get topics: One to many
     * @return [type] [description]
     */
    public function topics()
    {
        return $this->hasMany('App\Models\Topic', 'user_id');
    }

    /**
     * Get posts: One to many
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    /**
     * Get comments: One to many
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    /**
     * Get confessions: Many to many
     * @return [type] [description]
     */
    public function confessions()
    {
        return $this->belongsToMany('App\Models\Confession', 'confession_user', 'user_id', 'confession_id');
    }

    /**
     * Get all of the user's follows.
     */
    public function follows()
    {
        return $this->morphMany('App\Models\Follow', 'follow');
    }
}
