<?php

namespace App\Repositories\Contracts;

interface PostRepository extends AbstractRepository
{
    public function getAll($data = []);

    public function store($data = []);

    public function show($id);

    public function delete($id);
}
