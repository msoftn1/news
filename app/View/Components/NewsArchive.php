<?php

namespace App\View\Components;

use App\News;
use App\Repository\NewsRepository;
use App\Repository\SourceRepository;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Компонент архивов новостей.
 */
class NewsArchive extends Component
{
    /** Репозиторий источников. */
    private NewsRepository $newsRepository;

    /**
     * Конструктор.
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Рендеринг.
     *
     * @return View
     * @throws \Exception
     */
    public function render(): View
    {
        $data['archive'] = $this->newsRepository->getArchives();

        return view('components.archive', $data);
    }
}
