<?php

namespace App\Repositories;

use App\Constants\Constant;
use App\Helpers\CommonHelper;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * The repository model.
     *
     * @var Model
     */
    protected $model;

    /**
     * The query builder.
     *
     * @var Builder
     */
    protected $query;

    /**
     * Alias for the query limit.
     *
     * @var int
     */
    protected $take;

    /**
     * Array of related models to eager load.
     *
     * @var array
     */
    protected $with = [];

    /**
     * Array of one or more where clause parameters.
     *
     * @var array
     */
    protected $wheres = [];

    /**
     * Array of one or more where in clause parameters.
     *
     * @var array
     */
    protected $whereIns = [];

    /**
     * Array of one or more ORDER BY column/value pairs.
     *
     * @var array
     */
    protected $orderBys = [];

    /**
     * Array of scope methods to call on the model.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * BaseRepository constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * Make model
     *
     * @return Model|mixed
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->model = $model;
    }

    /**
     * Count the number of specified model records in the database.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->get()->count();
    }

    /**
     * Create a new model record in the database.
     * f
     *
     * @param array $data Data
     *
     * @return Model
     */
    public function store(array $data)
    {
        $this->unsetClauses();

        return $this->model->create($data);
    }

    /**
     * Create one or more new model records in the database.
     *
     * @param array $data Data
     *
     * @return Collection
     */
    public function createMultiple(array $data)
    {
        $models = new Collection();

        foreach ($data as $d) {
            $models->push($this->store($d));
        }

        return $models;
    }

    /**
     * Delete the specified model record from the database.
     *
     * @param integer $id ID
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id): bool
    {
        $this->unsetClauses();

        return $this->getById($id)->delete();
    }

    /**
     * Delete multiple records.
     *
     * @param array $ids Ids
     *
     * @return int
     */
    public function deleteMultipleById(array $ids): int
    {
        return $this->model->destroy($ids);
    }

    /**
     * Get the first specified model record from the database.
     *
     * @param array $columns Column name
     *
     * @return Model|static
     */
    public function first(array $columns = ['*'])
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $model = $this->query->firstOrFail($columns);

        $this->unsetClauses();

        return $model;
    }

    /**
     * Get all the specified model records in the database.
     *
     * @param array $columns Column name
     *
     * @return Collection|static[]
     */
    public function get(array $columns = ['*'])
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Get the specified model record from the database.
     *
     * @param integer $id Id
     * @param array $columns Column name
     *
     * @return Collection|Model
     */
    public function getById($id, array $columns = ['*'])
    {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->findOrFail($id, $columns);
    }

    /**
     * Create a new instance of the model's query builder.
     *
     * @return $this
     */
    protected function newQuery()
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

    /**
     * Add relationships to the query builder to eager load.
     *
     * @return $this
     */
    protected function eagerLoad()
    {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }

    /**
     * Set clauses on the query builder.
     *
     * @return $this
     */
    protected function setClauses()
    {
        foreach ($this->wheres as $where) {
            $this->query->where(
                $where['column'],
                $where['operator'],
                $where['value']
            );
        }

        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        if (isset($this->take) and !is_null($this->take)) {
            $this->query->take($this->take);
        }

        return $this;
    }

    /**
     * Set query scopes.
     *
     * @return $this
     */
    protected function setScopes()
    {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(implode(', ', $args));
        }

        return $this;
    }

    /**
     * Reset the query clause parameter arrays.
     *
     * @return $this
     */
    protected function unsetClauses()
    {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;

        return $this;
    }

    /**
     * Get All
     *
     * @return Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get one
     *
     * @param integer|array $id ID
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create
     *
     * @param array $attributes Attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     *
     * @param integer $id ID
     * @param array $attributes Attributes
     *
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Get one or throw exception
     *
     * @param integer|array $id ID
     *
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Add a simple where clause to the query.
     *
     * @param string $column column
     * @param string $value value for column
     * @param string $operator operator
     *
     * @return $this
     */
    public function where($column, $value, $operator = '=')
    {
        $this->wheres[] = compact('column', 'value', 'operator');

        return $this;
    }

    /**
     * Handle data paginate
     *
     * @param array $data
     *
     * @return array
     */
    public function handlePaginate($data)
    {
        $page[Constant::INPUT_PAGE_SIZE] = 10;
        $page[Constant::INPUT_PAGE] =  1;
        if (!empty($data[Constant::KEY_LIMIT])) {
            $page[Constant::INPUT_PAGE_SIZE] = $data[Constant::KEY_LIMIT];
        }
        if (isset($data[Constant::INPUT_PAGE])) {
            $pageNumber = (int)$data[Constant::INPUT_PAGE];
            $page[Constant::INPUT_PAGE] = $pageNumber;
        }
        return $page;
    }

    protected function paginate(Builder $query, array $pagination)
    {
        return $query->paginate(
            $pagination[Constant::INPUT_PAGE_SIZE],
            '*',
            Constant::INPUT_PAGE,
            $pagination[Constant::INPUT_PAGE]
        );
    }
    public function getTable(): string
    {
        return $this->model->getTable();
    }

}
