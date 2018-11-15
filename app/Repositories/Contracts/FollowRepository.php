<?php

namespace App\Repositories\Contracts;

interface FollowRepository extends AbstractRepository
{
    public function store($data = []);

    //xoa theo doi cua Topic
    public function delete($id);

//    xoa theo doi cua User
    public function deleteUserFollow($id);
}
