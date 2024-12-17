<?php

namespace App\Src\Abstracts;

use App\Src\Interfaces\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{

    /**
     * @return class-string<Model>
     */
    abstract protected function getModel(): string;

    public function getAll(): Collection
    {
        return $this->getModel()::query()->get();
    }

    public function getOne(int $id): Model
    {
        return $this->getModel()::query()->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->getModel()::query()->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->getModel()::query()->findOrFail($id);

        $model->fill($data);
        $model->save();

        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->getModel()::query()->findOrFail($id)->delete();
    }

}
