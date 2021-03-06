<?php

namespace App\Repositories\Contracts;

interface PermissionRepository extends AbstractRepository
{
    public function getAll($data = []);

    public function getAllNotPagination($data = []);

    public function store($data = []);

    public function find($id);

    public function update($id, $data = []);

    public function show($id);

    public function delete($id);
}
