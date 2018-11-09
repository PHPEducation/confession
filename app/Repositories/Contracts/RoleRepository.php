<?php

namespace App\Repositories\Contracts;

interface RoleRepository extends AbstractRepository
{
    public function getAll($data = []);

    public function store($data = []);

    public function find($id);

    public function update($id, $data = []);

    public function show($id);

    public function delete($id);
}
