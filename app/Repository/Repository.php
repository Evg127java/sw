<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 * @package App\Repositories
 */
class Repository implements RepositoryInterface
{
    /**
     * @var Model The model which the repository is initiated for
     */
    protected Model $model;

    /**
     * Sets the specified model which the repository will operate
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Gets all instances by specified order with specified relations
     * @param string $column order by
     * @param string $orderDirection order direction
     * @param array $relations instance's relations
     * @return Builder
     */
    public function getAllByOrderWithRelations(string $column, string $orderDirection, array $relations = [])
    {
        return $this->model::with($relations)->orderBy($column, $orderDirection);
    }

    /**
     * Gets all instances with their relations by the specified column name and value
     * @param string $column column name
     * @param string $value column value
     * @param array $relations instance's relations
     * @return Builder
     */
    public function getAllByColumnValueWithRelations(string $column, string $value, array $relations = [])
    {
        return $this->model::with($relations)->where($column, $value);
    }

    /**
     * Gets the only instance by the specified id
     * @param int $id instance's id value to get
     * @return mixed
     */
    public function getOneById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * Gets the only instance by the specified column value
     * @param string $column column name
     * @param string $value column value
     * @return mixed
     */
    public function getOneByColumnValue(string $column, string $value)
    {
        return $this->model::firstWhere($column, $value);
    }

    /**
     * Gets all instances from the DB
     * @return Collection|Model[]
     */
    public function getAll()
    {
        return $this->model::all();
    }

    /**
     * Add all passed instances to the DB
     * @param array $modelsSet instances array to add
     */
    public function addAll(array $modelsSet)
    {
        $this->model::insertOrIgnore($modelsSet);
    }

    /**
     * Gets the specified column value's id
     * @param string $column column name
     * @param string $value column value
     * @return mixed
     */
    public function getIdByColumnValue(string $column, string $value)
    {
        return $this->model::where($column, $value)->first()->id;
    }
}
