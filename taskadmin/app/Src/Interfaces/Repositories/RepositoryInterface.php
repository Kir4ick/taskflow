<?php

namespace App\Src\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T
 */
interface RepositoryInterface
{

    /**
     * @return Collection<T>
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     *
     * @return Model<T>
     */
    public function getOne(int $id): Model;

    /**
     * @param array $data
     *
     * @return Model<T>
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     *
     * @return Model<T>
     */
    public function update(int $id, array $data): Model;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
