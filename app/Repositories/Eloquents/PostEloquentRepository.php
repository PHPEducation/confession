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
        return $this->model()->orderBy('id', 'desc')->get();
    }

    public function getAllPaginate($data = [])
    {
        return $this->model()->with('topic')->paginate(config('common.paginate'));
    }

    public function store($data = [])
    {
        // TODO: Implement store() method.
        return $this->model()->create($data);
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

    public function getAllOfUser($id, $data = [])
    {
        $data = $this->model()->with('topic')->where([
            ['user_id', '=', $id],
            ['type', '=', 1],
        ])->get();

        return $data;
    }

    public function getAllOfTopic($id, $data = [])
    {
        $data = $this->model()->with('topic')->where([
            ['topic_id', '=', $id],
        ])->get();

        return $data;
    }
}
