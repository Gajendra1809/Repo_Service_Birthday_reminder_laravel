<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * This class provides a base implementation for common repository methods.
 * It allows for basic CRUD operations on a given model.
 */
class BaseRepository
{

    /**
     * The model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all records from the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a new record in the model.
     *
     * @param array $data
     * @return Model
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Find a record by its ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update a record by its ID.
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update($id, $data)
    {
        $modelInstance = $this->model->find($id);
        $modelInstance->update($data);
        return $modelInstance;
    }

    /**
     * Delete a record by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $modelInstance = $this->model->find($id);
        $modelInstance->delete();
        return true;
    }
}
