<?php

namespace App\Repositories\Contracts;

interface UserRepository extends AbstractRepository
{
    public function getAllUser($data = []);

    public function showDetail($id);
}
