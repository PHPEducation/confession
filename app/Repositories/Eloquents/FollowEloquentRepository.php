<?php

namespace App\Repositories\Eloquents;

use App\Models\Follow;
use App\Repositories\Contracts\FollowRepository;
use Illuminate\Support\Facades\Auth;

class FollowEloquentRepository extends AbstractEloquentRepository implements FollowRepository
{

    public function model()
    {
        return new Follow;
    }

    public function store($data = [])
    {
        return $this->model()->create($data);
    }

    public function delete($id)
    {
        $model = $this->model()->where([
            'follow_id' => $id,
            'user_id' => Auth::id(),
            'follow_type' => 'App\Models\Topic',
        ])->first();

        return $model->delete();
    }
}
