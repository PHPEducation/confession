<?php

namespace App\Repositories\Contracts;

use App\Models\Topic;

interface TopicRepository extends AbstractRepository
{
    public function getAll($data = []);

    public function getAllEnable($data = []);

    public function getAllLimit($data = []);

    public function all($data = []);

    public function store($data = []);

    public function find($id);

    public function update($id, $data = []);

    public function show($id);

    public function delete($id);
}
