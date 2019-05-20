<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var
     */
    private $app;
    protected $model;

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @return Model
     * @throws Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception(trans('common/errors.exceptions.not-instance', ['model' => $this->model()]));
        }

        return $this->model = $model;
    }

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->all();
    }

    public function getWith($option, $id)
    {
        return $this->model->with($option)->findOrFail($id);
    }
    /**
     * Retrieve data array for populate field select
     *
     * @param string      $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null   $limit
     * @param array  $columns
     *
     * @return mixed
     */
    public function paginate($columns = ['*'], $limit = null)
    {
        $limit = is_null($limit) ? config('settings.pagination.limit') : $limit;
        return $this->model->paginate($limit, $columns);
    }

    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findBy($column, $option)
    {
        $data = $this->model->where($column, $option)->get();

        return $data;
    }

    public function findBySlug($slug)
    {
        $data = $this->model->name($slug)->first();

        return $data;
    }
    public function where($conditions, $operator = null, $value = null)
    {
        if (func_num_args() == 2) {
            list($value, $operator) = [$operator, '='];
        }
        return $this->model->where($conditions, $operator, $value);
    }

    /**
     * Save a new entity in repository
     *
     * @throws Exception
     *
     * @param array $input
     *
     * @return mixed
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a entity in repository by id
     *
     * @throws Exception
     *
     * @param array $input
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id, $withSoftDeletes = false)
    {
        $model = $this->model->find($id);
        $fillable = $this->model->getFillable();
        $data = array_only($data, $fillable);
        $model->fill($data);

        return $model->save();
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
