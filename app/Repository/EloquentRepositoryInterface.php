<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

/**
 * Интерфейс репозиториев.
 */
interface EloquentRepositoryInterface
{
    /**
     * Создать объект.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Поиск по ID
     *
     * @param string $id
     * @return Model
     */
    public function find(string $id): ?Model;
}
