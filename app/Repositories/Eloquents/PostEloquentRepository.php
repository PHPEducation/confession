<?php

namespace App\Repositories\Eloquents;

use App\Models\Post;
use App\Repositories\Contracts\PostRepository;

class PostEloquentRepository extends AbstractEloquentRepository implements PostRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return new Post;
    }

    public function getAll($data = [])
    {
        // TODO: Implement getAll() method.
        return $this->model()->all();
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        $data = $this->model()->findOrFail($id);

        return $data;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $model = $this->model()->findOrFail($id);

        return $model->delete();
    }
}
