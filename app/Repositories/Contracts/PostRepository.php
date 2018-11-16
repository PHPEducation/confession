<?php

namespace App\Repositories\Contracts;

interface PostRepository extends AbstractRepository
{
    public function getAll($data = []);

    public function getAllPaginate($data = []);

    public function store($data = []);

    public function show($id);

    public function delete($id);

    public function getAllOfUser($id, $data = []);

    public function getAllOfTopic($id, $data = []);
}
