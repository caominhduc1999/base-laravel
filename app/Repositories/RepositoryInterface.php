<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * Get all.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function get($id): Model|array;

    /**
     * With.
     *
     * @param array $withModel
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function with(array $withModel = ['']): Model;



    /**
     * Store.
     *
     * @param array $data
     *
     * @return
     */
    public function store($data): Model;

    /**
     * Insert.
     *
     * @param array $data
     *
     * @return
     */
    public function insert($data): Model|array;

    /**
     * Update.
     *
     * @param int $id
     * @param array $data
     *
     * @return Model
     */
    public function update($id, $data): bool;

    /**
     * Delete.
     *
     * @param Collection|array|int $ids
     *
     * @return int
     */
    public function destroy($ids): void;

    /**
     * Check exist.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function exist($id): bool;

    /**
     * Get total.
     *
     * @return int
     */
    public function total(): int;

    /**
     * Check field existed.
     *
     * @param string $field
     * 
     * @param mixed $value
     * 
     * @return bool
     */
    public function isFieldExist($field, $value): bool;

    /**
     * Check fields existed.
     *
     * @param array $data
     * 
     * @return bool
     */
    public function isFieldsExist($data): bool;

    /**
     * updateOrCreate.
     *
     * @param array $condition
     * 
     * @param array $data
     * 
     * @return mixed
     */
    public function updateOrCreate($condition, $data): mixed;

    /**
     * findByField.
     *
     * @param string $field
     * 
     * @param mixed $value
     * 
     * @return mixed
     */
    public function findByField($field, $value): mixed;

    /**
     * findByFields.
     *
     * @param array $conditions
     * 
     * @return mixed
     */
    public function findByFields($conditions): mixed;

    /**
     * delete.
     *
     * @param array $conditions
     * 
     * @return mixed
     */
    public function delete($conditions): mixed;

    /**
     * find.
     *
     * @param int $id
     * 
     * @return mixed
     */
    public function find($id): mixed;

    /**
     * upsert.
     *
     * @param array $data
     * 
     * @param array $condition
     * 
     * @return mixed
     */
    public function upsert($data, $condition): mixed;

    /**
     * findOrFail.
     *
     * @param int $id
     * 
     * @return mixed
     */
    public function findOrFail($id): mixed;

    /**
     * firstOrCreate.
     *
     * @param array $condition
     * 
     * @param array $data
     * 
     * @return mixed
     */
    public function firstOrCreate($condition, $data = []): mixed;

    /**
     * getLatest.
     *
     * @return mixed
     */
    public function getLatest(): mixed;

    /**
     * forceDelete.
     * 
     * @param array $condition
     *
     * @return mixed
     */
    public function forceDelete($condition): mixed;
}
