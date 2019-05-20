<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($columns = ['*']);

    public function getWith($option, $id);

    public function lists($column, $key = null);

    public function paginate($limit = null, $columns = ['*']);

    public function find($id, $columns = ['*']);

    public function findBy($column, $option);

    public function findBySlug($slug);

    public function where($conditions, $operator = null, $value = null);

    public function create(array $input);

    public function delete($id);

    public function update(array $data, $id, $withSoftDeletes = false);
}
