<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{

    public function model()
    {
        return new User;
    }

    public function getAllUser($data = [])
    {
        return $this->model()->where([
            ['type', '<>', 1],
            ['id', '<>', Auth::id()],
        ])->get();
    }
}
