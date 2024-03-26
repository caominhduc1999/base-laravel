<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * @var object Model name
     */
    protected $model;

    /**
     * @var string Table name
     */
    protected $table;

    /**
     * @var array Validation rules for store
     */
    protected $storeRules;

    /**
     * @var array Validation rules for update
     */
    protected $updateRules;

    /**
     * @var array Column names
     */
    protected $columnNames;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get all.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find.
     *
     * @param int $id
     *
     * @return array
     */
    public function get($id): Model|array
    {
        $model = $this->model::findOrFail($id);

        return empty($model) ? [] : $model;
    }

    /**
     * With.
     *
     * @param array $withModel
     *
     * @return Model
     */
    public function with(array $withModel = ['']): Model
    {
        $model = $this->with($withModel);

        return $model;
    }

    /**
     * Store.
     *
     * @param array $data
     *
     * @return object
     */
    public function store($data): Model
    {
        return $this->model::create($data);
    }

    /**
     * Insert.
     *
     * @param array $data
     *
     * @return void
     */
    public function insert($data): Model|array
    {
        return $this->model::insert($data);
    }


    /**
     * Update.
     *
     * @param $id
     * @param array $data
     *
     * @return void
     */
    public function update($id, $data): bool
    {
        try {
            return $this->model::findOrFail($id)->update($data);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Destroy.
     *
     * @param Collection|array|int $ids
     *
     * @return void
     */
    public function destroy($ids): void
    {
        $this->model::destroy($ids);
    }

    /**
     * Check exist.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function exist($id): bool
    {
        return !empty($this->find($id));
    }

    /**
     * Get Total.
     *
     * @return int
     */
    public function total(): int
    {
        return count($this->model->all());
    }

    /**
     * Check field existed.
     *
     * @param string $field
     * 
     * @param mixed $value
     * 
     * @return bool
     */
    public function isFieldExist($field, $value): bool
    {
        return $this->model::where($field, $value)->count() > 0;
    }


    /**
     * Check fields existed.
     *
     * @param array $data
     * 
     * @return bool
     */
    public function isFieldsExist($data): bool
    {
        return $this->model::where($data)->count() > 0;
    }

    /**
     * updateOrCreate.
     *
     * @param array $condition
     * 
     * @param array $data
     * 
     * @return mixed
     */
    public function updateOrCreate($condition, $data): mixed
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    /**
     * findByField.
     *
     * @param string $field
     * 
     * @param mixed $value
     * 
     * @return mixed
     */
    public function findByField($field, $value): mixed
    {
        return $this->model->where($field, $value);
    }

    /**
     * findByFields.
     *
     * @param array $conditions
     * 
     * @return mixed
     */
    public function findByFields($conditions): mixed
    {
        return $this->model->where($conditions);
    }

    /**
     * delete.
     *
     * @param array $conditions
     * 
     * @return mixed
     */
    public function delete($conditions): mixed
    {
        return $this->model::where($conditions)->delete();
    }

    /**
     * find.
     *
     * @param int $id
     * 
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->model::find($id);
    }

    /**
     * upsert.
     *
     * @param array $data
     * 
     * @param array $condition
     * 
     * @return mixed
     */
    public function upsert($data, $condition): mixed
    {
        return $this->model->upsert($data, $condition, 'cancel_division');
    }

    /**
     * findOrFail.
     *
     * @param int $id
     * 
     * @return mixed
     */
    public function findOrFail($id): mixed
    {
        return $this->model->findOrFail($id);
    }

    /**
     * firstOrCreate.
     *
     * @param array $condition
     * 
     * @param array $data
     * 
     * @return mixed
     */
    public function firstOrCreate($condition, $data = []): mixed
    {
        if (!$data) {
            $data = $condition;
        }

        return $this->model->firstOrCreate($condition, $data);
    }

    /**
     * getLatest.
     *
     * @return mixed
     */
    public function getLatest(): mixed
    {
        return $this->model->latest('id')->first();
    }

    /**
     * forceDelete.
     * 
     * @param array $condition
     *
     * @return mixed
     */
    public function forceDelete($condition): mixed
    {
        return $this->model::where($condition)->forceDelete();
    }
}
