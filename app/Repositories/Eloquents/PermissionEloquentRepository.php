<?php

namespace App\Repositories\Eloquents;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepository;

class PermissionEloquentRepository extends AbstractEloquentRepository implements PermissionRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return new Permission;
    }

    public function getAll($data = [])
    {
        // TODO: Implement getAll() method.
        return $this->model()->paginate(config('common.paginate'));
    }

    public function getAllNotPagination($data = [])
    {
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
