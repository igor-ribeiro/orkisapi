<?php

namespace OrkisApp\Repositories;

use Illuminate\Database\Eloquent\Modeli as EloquentModel;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;

abstract class BaseRepository {

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var string
     */
    protected $model;

    public function __construct()
    {
        $this->model = 'OrkisApp\\Models\\' . $this->modelClass;
    }

    /**
     * @return EloquentQueryBuilder|QueryBuilder
     */
    protected function query()
    {
        return app()->make($this->model)->newQuery();
    }

    /**
     * Execute a query
     * 
     * @param  EloquentQueryBuilder|QueryBuilder  $query
     * @param  integer                            $take
     * @param  boolean                            $paginate
     * @return EloquentCollection
     */
    protected function execute($query = null, $take = null, $paginate = true)
    {
        $take = is_null($take)
            ? config('app.per_page')
            : $take;

        $query = is_null($query)
            ? $this->query()
            : $query;

        if ($paginate) {
            return $query->paginate($take);
        }

        if ($take > 0 || $take) {
            $query->take($take);
        }

        return $query->get(); 
    }

    /**
     * Create a new model with given attributes
     *
     * @param  array  $attributes
     * @return EloquentModel
     */
    public function create(array $attributes)
    {
        $model = app()->make($this->model)->newInstance($attributes);
        $model->save();

        return $model;
    }

    /**
     * Update a given model with given attributes
     * 
     * @param         $model
     * @param  array  $attributes
     * @return EloquentModel
     */
    public function update($model, array $attributes)
    {
        $model->update($attributes);

        return $model;
    }

    /**
     * Delete a given model
     * 
     * @param  EloquentModel  $model
     * @return EloquentModel
     */
    public function delete($model)
    {
        $model->delete();

        return $model;
    }

    /**
     * Return all the resources
     * 
     * @param  integer $take
     * @param  boolean $paginate
     * @return EloquentCollection
     */
    public function all($take = null, $paginate = true)
    {
        return $this->execute(null, $take, $paginate);
    }
}
