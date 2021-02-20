<?php

namespace App\Repositories;

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
     * Find a entry.
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
     * @param string/integer $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data): Model
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    /**
     * Delete a entry.
     *
     * @param string/integer $id
     * @return integer
     */
    public function delete($id): int
    {
        return $this->model
            ->where($this->model->getKeyName(), $id)
            ->delete();
    }
}
