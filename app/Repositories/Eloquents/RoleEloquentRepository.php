<?php

namespace App\Repositories\Eloquents;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;

class RoleEloquentRepository extends AbstractEloquentRepository implements RoleRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return new Role();
    }

    public function getAll($data = [])
    {
        // TODO: Implement getAll() method.
        return $this->model()->all();
    }

    public function store($data = [])
    {
        // TODO: Implement store() method.
        return $this->model()->create($data);
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        return $this->model()->findOrFail($id);
    }

    public function update($id, $data = [])
    {
        // TODO: Implement update() method.
        $model = $this->model()->findOrFail($id);

        return $model->update($data);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        return $this->model()->findOrFail($id);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $model = $this->model()->findOrFail($id);

        return $model->delete();
    }
}
