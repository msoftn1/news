<?php

namespace App\Http\Controllers;

use App\Repository\NewsRepository;
use App\Repository\SourceRepository;
use App\Services\BreadcrumbsService;
use App\Services\ResizeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Контроллер новостей.
 */
class NewsController extends Controller
{
    /** Репозиторий источников новостей. */
    private SourceRepository $sourceRepository;

    /** Репозиторий новостей. */
    private NewsRepository $newsRepository;

    /** Сервис breadcrumbs. */
    private BreadcrumbsService $breadcrumbs;

    /** Сервис ресайза. */
    private ResizeService $resizeService;

    /**
     * Конструктор.
     *
     * @param SourceRepository $sourceRepository
     * @param NewsRepository $newsRepository
     * @param BreadcrumbsService $breadcrumbs
     * @param ResizeService $resizeService
     */
    public function __construct(
        SourceRepository $sourceRepository,
        NewsRepository $newsRepository,
        BreadcrumbsService $breadcrumbs,
        ResizeService $resizeService
    )
    {
        $this->sourceRepository = $sourceRepository;
        $this->newsRepository = $newsRepository;
        $this->breadcrumbs = $breadcrumbs;
        $this->resizeService = $resizeService;
    }

    /**
     * Главная страница.
     *
     * @return View
     */
    public function index(): View
    {
        $topNews = $this->newsRepository->getTopNews();

        return view('main.index',
            [
                'topNews' => count($topNews) > 0 ? $topNews[0] : null,
                'topNewsBusiness' => count($topNews) > 1 ? $topNews[1] : null,
                'topNewsTechnology' => count($topNews) > 2 ? $topNews[2] : null,
                'mainNews' => $topNews->slice(3, 10)
            ]
        );
    }

    /**
     * Картинка.
     *
     * @param string $name
     * @return BinaryFileResponse
     */
    public function image(string $name): BinaryFileResponse
    {
        $name = str_replace(['..', '.', '/', '\\'], '', $name);
        $nameData = explode('_', $name);
        if (count($nameData) != 2) {
            return redirect('404');
        }

        $fileName = $nameData[0] . '.' . $nameData[1];
        $path = $this->resizeService->resize($fileName);

        $headers = ['Content-Type' => mime_content_type($path)];
        return new BinaryFileResponse($path, 200, $headers);
    }

    /**
     * Источники.
     *
     * @return View
     */
    public function sources(): View
    {
        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addSources()
            ->get();

        return view('main.sources',
            [
                'sources' => $this->sourceRepository->getSourcesGroupByName(),
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Источник по идентификатору.
     *
     * @param string $id
     * @return View
     */
    public function sourceById(string $id): View
    {
        $source = $this->sourceRepository->findByIdentifier($id);

        if (!$source) {
            return redirect('404');
        }

        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addSources()
            ->addSource($source)
            ->get();

        $news = $this->newsRepository->findBySource($id);

        return view('main.sourcesById',
            [
                'id' => $id,
                'news' => $news,
                'source' => $source,
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Авторы.
     *
     * @return View
     */
    public function authors(): View
    {
        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addAuthors()
            ->get();

        return view('main.authors',
            [
                'authors' => $this->newsRepository->getAuthors(),
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Автор по идентификатору.
     *
     * @param string $id
     * @return View
     */
    public function authorById(string $id): View
    {
        $id = urldecode($id);

        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addAuthors()
            ->addAuthor($id)
            ->get();

        return view('main.authorById',
            [
                'id' => $id,
                'news' => $this->newsRepository->findNewsByAuthor($id),
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Страница новости.
     *
     * @param int $id
     * @return View
     */
    public function view(int $id): View
    {
        $newsItem = $this->newsRepository->find($id);

        if (!$newsItem) {
            return redirect('404');
        }

        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addCategory($newsItem->source()->category)
            ->addNews($newsItem)
            ->get();

        return view('main.view',
            [
                'newsItem' => $newsItem,
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Поиск новостей по датам.
     *
     * @param string $dateStart
     * @param string $dateEnd
     * @return View
     */
    public function date(string $dateStart, string $dateEnd): View
    {
        try {
            $date = (new \DateTime($dateStart))->format('F Y');
        } catch (\Exception $e) {
            return redirect('404');
        }

        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addDate($dateStart, $dateEnd, $date)
            ->get();

        return view('main.date',
            [
                'news' => $this->newsRepository->findNewsByPublishedAt($dateStart, $dateEnd),
                'date' => $date,
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Язык.
     *
     * @param string $language
     * @return View
     */
    public function language(string $language): View
    {
        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addLanguage($language)
            ->get();

        return view('main.language',
            [
                'news' => $this->newsRepository->findByLanguage($language),
                'language' => $language,
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * Категория.
     *
     * @param string $category
     * @return View
     */
    public function category(string $category): View
    {
        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addCategory($category)
            ->get();

        return view('main.category',
            [
                'news' => $this->newsRepository->findByCategory($category),
                'category' => $category,
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }

    /**
     * AJAX поиск.
     *
     * @param Request $request
     * @return Response
     */
    public function searchAjax(Request $request): Response
    {
        $term = trim(urldecode($request->get('term')));
        $news = $this->newsRepository->searchNews($term);

        $res = [];
        foreach ($news as $newsItem) {
            $res[] = $newsItem->title;
        }

        return $this->jsonResponse($res);
    }

    /**
     * Поиск.
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $search = $request->get('search');
        $searchDecode = urldecode($search);

        if (empty($search)) {
            return redirect('404');
        }

        $breadcrumbs = $this->breadcrumbs->getBuilder()
            ->addMain()
            ->addSearch($searchDecode)
            ->get();

        return view('main.search',
            [
                'news' => $this->newsRepository->searchNewsPaginate($searchDecode),
                'search' => $searchDecode,
                'breadcrumbs' => $breadcrumbs
            ]
        );
    }
}
