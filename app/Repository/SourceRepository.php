<?php


namespace App\Repository;

use App\Source;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий источников.
 */
class SourceRepository extends BaseRepository
{
    /**
     * Конструктор.
     *
     * @param Source $model
     */
    public function __construct(Source $model)
    {
        parent::__construct($model);
    }

    /**
     * Наличие по идентификатору.
     *
     * @param string $identifier
     * @return bool
     */
    public function existsByIdentifier(string $identifier): bool
    {
        return $this->model->newQuery()
            ->where('identifier', $identifier)
            ->exists();
    }

    /**
     * Поиск по идентификатору.
     *
     * @param string $identifier
     * @return Source|null
     */
    public function findByIdentifier(string $identifier): ?Source
    {
        return $this->model->newQuery()
            ->where('identifier', $identifier)
            ->first();
    }

    /**
     * Список.
     *
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->model->newQuery()
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Идентификаторы источников.
     *
     * @return Collection
     */
    public function getSourcesGroupByName(): Collection
    {
        return Source::cacheFor(600)
            ->select('identifier', 'name')
            ->groupBy(['identifier', 'name'])
            ->get();
    }

    /**
     * Получить категории.
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return Source::cacheFor(600)
            ->select('category')
            ->groupBy('category')
            ->get();
    }

    /**
     * Получить языки.
     *
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return Source::cacheFor(600)
            ->selectRaw('language')
            ->groupBy('language')
            ->orderBy('language', 'asc')
            ->get();
    }

    /**
     * Получить название источников.
     *
     * @return Collection
     */
    public function getNames(): Collection
    {
        return Source::cacheFor(600)
            ->selectRaw('name')
            ->groupBy('name')
            ->orderBy('name', 'asc')
            ->get();
    }
}
