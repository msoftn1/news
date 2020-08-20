<?php

namespace App\View\Components;

use App\Repository\SourceRepository;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Компонент категорий.
 */
class Categories extends Component
{
    /** Репозиторий источников. */
    private SourceRepository $sourceRepository;

    /**
     * Конструктор.
     * @param SourceRepository $sourceRepository
     */
    public function __construct(SourceRepository $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    /**
     * Рендеринг.
     *
     * @return View
     */
    public function render(): View
    {
        $data['categories'] = $this->sourceRepository->getCategories();

        return view('components.categories', $data);
    }
}
