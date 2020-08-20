<?php


namespace App\Http\Controllers;


use App\Repository\NewsRepository;
use App\Repository\SourceRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Контроллер API.
 */
class ApiController extends Controller
{
    /** Репозиторий источников новостей. */
    private SourceRepository $sourceRepository;

    /** Репозиторий новостей. */
    private NewsRepository $newsRepository;

    /**
     * Конструктор.
     *
     * @param SourceRepository $sourceRepository
     * @param NewsRepository $newsRepository
     */
    public function __construct(SourceRepository $sourceRepository, NewsRepository $newsRepository)
    {
        $this->sourceRepository = $sourceRepository;
        $this->newsRepository = $newsRepository;
    }

    /**
     * Источники.
     *
     * @return Response
     */
    public function sources(): Response
    {
        $source = $this->sourceRepository->get();

        return $this->jsonResponse(
            [
                'count' => count($source),
                'data' => $source
            ]
        );
    }

    /**
     * Новости по источнику.
     *
     * @param Request $request
     * @return Response
     */
    public function newsBySource(Request $request): Response
    {
        $source = $request->get('source', '');
        $paginate = $this->getPaginate($request);
        $newsData = $this->newsRepository->findBySourceApi($source, $paginate['offset'], $paginate['limit']);

        return $this->jsonResponseWithPaginate($newsData['items'], $newsData['totalCount'], $paginate['page'], $paginate['limit']);
    }

    /**
     * Новости по языку.
     *
     * @param Request $request
     * @return Response
     */
    public function newsByLanguage(Request $request): Response
    {
        $language = $request->get('language', '');
        $paginate = $this->getPaginate($request);
        $newsData = $this->newsRepository->findByLanguageApi($language, $paginate['offset'], $paginate['limit']);

        return $this->jsonResponseWithPaginate($newsData['items'], $newsData['totalCount'], $paginate['page'], $paginate['limit']);
    }

    /**
     * Новости по категории.
     *
     * @param Request $request
     * @return Response
     */
    public function newsByCategory(Request $request): Response
    {
        $category = $request->get('category', '');
        $paginate = $this->getPaginate($request);
        $newsData = $this->newsRepository->findByCategoryApi($category, $paginate['offset'], $paginate['limit']);

        return $this->jsonResponseWithPaginate($newsData['items'], $newsData['totalCount'], $paginate['page'], $paginate['limit']);
    }

    /**
     * Новости по стране.
     *
     * @param Request $request
     * @return Response
     */
    public function newsByCountry(Request $request): Response
    {
        $country = $request->get('country', '');
        $paginate = $this->getPaginate($request);
        $newsData = $this->newsRepository->findByCountryApi($country, $paginate['offset'], $paginate['limit']);

        return $this->jsonResponseWithPaginate($newsData['items'], $newsData['totalCount'], $paginate['page'], $paginate['limit']);
    }

    /**
     * Поиск новостей.
     *
     * @param Request $request
     * @return Response
     */
    public function newsSearch(Request $request): Response
    {
        $search = urldecode($request->get('search', ''));
        $paginate = $this->getPaginate($request);
        $newsData = $this->newsRepository->searchNewsApi($search, $paginate['offset'], $paginate['limit']);

        return $this->jsonResponseWithPaginate($newsData['items'], $newsData['totalCount'], $paginate['page'], $paginate['limit']);
    }

    /**
     * Пагинация.
     *
     * @param Request $request
     * @return array
     */
    private function getPaginate(Request $request): array
    {
        $page = (int)$request->get('page', 1);
        $limit = (int)$request->get('limit', 100);
        $offset = (($page - 1) * $limit);

        return [
            'page' => $page,
            'limit' => $limit,
            'offset' => $offset
        ];
    }
}
