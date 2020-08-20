<?php


namespace App\Repository;

use App\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Репозиторий новостей.
 */
class NewsRepository extends BaseRepository
{
    /**
     * Конструктор.
     *
     * @param News $model
     */
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    /**
     * Проверитб наличие новости по автору и дате публикации.
     *
     * @param string $author
     * @param string $publishedAt
     * @return bool
     */
    public function existsByAuthorAndPublishedAt(string $author, string $publishedAt): bool
    {
        return $this->model->newQuery()
            ->where('author', $author)
            ->where('published_at', $publishedAt)
            ->exists();
    }

    /**
     * Получить топовые новости.
     *
     * @return LengthAwarePaginator
     */
    public function getTopNews(): LengthAwarePaginator
    {
        return $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.language', 'en')
            ->orderBy('news.published_at', 'desc')
            ->paginate(15);
    }

    /**
     * Поиск по источнику.
     *
     * @param string $identifier
     * @return LengthAwarePaginator
     */
    public function findBySource(string $identifier): LengthAwarePaginator
    {
        return $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.identifier', $identifier)
            ->orderBy('news.published_at', 'desc')
            ->paginate(15);
    }

    /**
     * Поиск по источнику в формате для API.
     *
     * @param string $identifier
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function findBySourceApi(string $identifier, int $offset, int $limit): array
    {
        $newsQuery = $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.identifier', $identifier)
            ->orderBy('news.published_at', 'desc');

        return $this->api($newsQuery, $offset, $limit);
    }

    /**
     * Авторы.
     *
     * @return LengthAwarePaginator
     */
    public function getAuthors(): LengthAwarePaginator
    {
        return $this->createNewsQuery()
            ->select('author')
            ->whereRaw('author NOT LIKE \'%@type%\'')
            ->whereRaw('author NOT LIKE \'%<a href%\'')
            ->groupBy('author')
            ->paginate(50);
    }

    /**
     * Новости по автору.
     *
     * @return LengthAwarePaginator
     */
    public function findNewsByAuthor(string $author): LengthAwarePaginator
    {
        $res = $this->createNewsQuery()
            ->select('news.*')
            ->where('news.author', $author)
            ->orderBy('news.published_at', 'desc')
            ->paginate(15);

        return $res;
    }

    /**
     * Новости по датам публикации.
     *
     * @param string $dateStart
     * @param string $dateEnd
     * @return LengthAwarePaginator
     */
    public function findNewsByPublishedAt(string $dateStart, string $dateEnd): LengthAwarePaginator
    {
        return $this->createNewsQuery()
            ->whereBetween('published_at', [$dateStart, $dateEnd])
            ->orderBy('news.published_at', 'desc')
            ->paginate(15);
    }

    /**
     * Новости по языку.
     *
     * @return LengthAwarePaginator
     */
    public function findByLanguage(string $language): LengthAwarePaginator
    {
        return $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.language', $language)
            ->orderBy('news.published_at', 'desc')
            ->paginate(15);
    }

    /**
     * Новости по языку для API.
     *
     * @param string $language
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function findByLanguageApi(string $language, int $offset, int $limit): array
    {
        $newsQuery = $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.language', $language)
            ->orderBy('news.published_at', 'desc');

        return $this->api($newsQuery, $offset, $limit);
    }

    /**
     * Новости по категории.
     *
     * @param string $category
     * @return LengthAwarePaginator
     */
    public function findByCategory(string $category): LengthAwarePaginator
    {
        return $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.category', $category)
            ->orderBy('news.published_at', 'desc')
            ->paginate(15);
    }

    /**
     * Новости по категории для API.
     *
     * @param string $category
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function findByCategoryApi(string $category, int $offset, int $limit): array
    {
        $newsQuery = $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.category', $category)
            ->orderBy('news.published_at', 'desc');

        return $this->api($newsQuery, $offset, $limit);
    }

    /**
     * Новости по стране для API.
     *
     * @param string $country
     * @param int $offset
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function findByCountryApi(string $country, int $offset, int $limit): LengthAwarePaginator
    {
        $newsQuery = $this->createNewsQuery()
            ->select('news.*')
            ->leftJoin('sources', 'news.source_id', '=', 'sources.id')
            ->where('sources.country', $country)
            ->orderBy('news.published_at', 'desc');

        return $this->api($newsQuery, $offset, $limit);
    }

    /**
     * Билдер для поиска новостей.
     *
     * @param string $query
     * @return Builder
     */
    protected function searchNewsQuery(string $query): Builder
    {
        $termMatch = DB::connection()->getPdo()->quote($query);
        $termLike = str_replace(['"', '\''], '', DB::connection()->getPdo()->quote('%' . $query . '%'));

        return $this->createNewsQuery()
            ->where(function (\Illuminate\Database\Eloquent\Builder $query) use ($termMatch) {
                $query->whereRaw('MATCH (title) AGAINST (' . $termMatch . ' IN NATURAL LANGUAGE MODE)')
                    ->orWhereRaw('MATCH (description) AGAINST (' . $termMatch . ' IN NATURAL LANGUAGE MODE)');
            })->orWhere(function (\Illuminate\Database\Eloquent\Builder $query) use ($termLike) {
                $query->where('title', 'LIKE', $termLike)
                    ->orWhere('description', 'LIKE', $termLike);
            });
    }

    /**
     * Поиск новостей.
     *
     * @param string $query
     * @return Collection
     */
    public function searchNews(string $query): Collection
    {
        return $this->searchNewsQuery($query)
            ->limit(10)
            ->get();
    }

    /**
     * Поиск новостей для API.
     *
     * @param string $query
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function searchNewsApi(string $query, int $offset, int $limit): array
    {
        return $this->api($this->searchNewsQuery($query), $offset, $limit);
    }

    /**
     * Поиск новостей пагинация.
     *
     * @param string $query
     * @return LengthAwarePaginator
     */
    public function searchNewsPaginate(string $query): LengthAwarePaginator
    {
        $term = DB::connection()->getPdo()->quote($query);

        return $this->createNewsQuery()
            ->select('news.*')
            ->where(function (\Illuminate\Database\Eloquent\Builder $query) use ($term) {
                $query->whereRaw('MATCH (title) AGAINST (' . $term . ' IN NATURAL LANGUAGE MODE)')
                    ->orWhereRaw('MATCH (description) AGAINST (' . $term . ' IN NATURAL LANGUAGE MODE)');
            })
            ->paginate(15);
    }

    /**
     * Получить даты архивов новостей.
     *
     * @return Collection
     * @throws \Exception
     */
    public function getArchives(): Collection
    {
        $archive = News::cacheFor(600)
            ->selectRaw('YEAR(published_at) as year, MONTH(published_at) as month')
            ->groupByRaw('YEAR(published_at), MONTH(published_at)')
            ->orderBy('published_at', 'desc')
            ->limit(12)
            ->get();

        foreach ($archive as $item) {
            $dateTime = new \DateTime(sprintf('%s-%s-1', $item->year, $item->month));
            $item->date = $dateTime->format('F Y');
            $item->dateStart = $dateTime->format('Y-m-d');
            $item->dateEnd = $dateTime->modify('+1 MONTH')->format('Y-m-d');
        }

        return $archive;
    }

    /**
     * Выполнить запрос для API.
     *
     * @param Builder $newsQuery
     * @param int $offset
     * @param int $limit
     * @return array
     */
    private function api(Builder $newsQuery, int $offset, int $limit): array
    {
        $count = $newsQuery->count();
        $items = $newsQuery->limit($limit)
            ->offset($offset)
            ->get();

        foreach ($items as $item) {
            $item->image = ENV('APP_URL') . '/' . $item->image;
        }

        return [
            'totalCount' => $count,
            'items' => $items
        ];
    }

    /**
     * Билдер для запросов к новостям.
     *
     * @return Builder
     */
    private function createNewsQuery(): Builder
    {
        return News::cacheFor(600)
            ->whereRaw('author NOT LIKE \'%@type%\'')
            ->whereRaw('author NOT LIKE \'%<a href%\'');
    }
}
