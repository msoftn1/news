<?php

namespace App\View\Components;

use App\Repository\SourceRepository;
use App\Source;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Компонент языков.
 */
class Languages extends Component
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
        $data['languages'] = $this->sourceRepository->getLanguages();

        return view('components.languages', $data);
    }
}
