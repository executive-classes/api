<?php

namespace App\Support\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * The Model of the repository
     * 
     * @var Model
     */
    protected $model;

    /**
     * Get a list of models.
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->model->get();
    }

    /**
     * Find a entry by id.
     *
     * @param string|integer $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model
            ->where($this->model->getKeyName(), $id)
            ->first();
    }

    /**
     * Create a entry
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $model = new $this->model($data);
        $model->save();
        return $model;
    }

    /**
     * Update a entry.
     *
     * @param Model|string|integer $id
     * @param array $data
     * @return Model
     */
    public function update($model, array $data): Model
    {
        if (!$model instanceof Model) {
            $model = $this->find($model);
        }

        $model->update($data);
        return $model;
    }

    /**
     * Delete a entry.
     *
     * @param Model|string|integer $id
     * @return integer
     */
    public function delete($model): int
    {
        if (!$model instanceof Model) {
            $model = $this->find($model);
        }

        return $model->delete();
    }

    /**
     * Validate if the model is a string with the ID or the 
     * instance of the model.
     *
     * @param Model|string $model
     * @return Model
     */
    protected function getModel($model): Model
    {
        if (!$model instanceof $this->model) {
            return $this->find($model);
        }

        return $model;
    }
}
