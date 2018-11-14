<?php

namespace App\Repositories\Contracts;

interface FollowRepository extends AbstractRepository
{
    public function store($data = []);

    public function delete($id);
}
