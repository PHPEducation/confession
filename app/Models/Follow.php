<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'follows';

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
        'follow_id',
        'follow_type',
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
     * Get all of the owning followTable models.
     */
    public function follow()
    {
        return $this->morphTo();
    }
}
