<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

/**
 * Базовый класс репозитория.
 */
class BaseRepository implements EloquentRepositoryInterface
{
    /** Модель. */
    protected Model $model;

    /**
     * Конструктор.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $attributes): Model
    {
        $class = \get_class($this->model);
        $model = new $class();

        foreach ($attributes as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        return $model;
    }

    /**
     * {@inheritDoc}
     */
    public function find(string $id): ?Model
    {
        return $this->model->find($id);
    }
}
