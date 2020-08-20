<?php

namespace App\View\Components;

use App\Repository\SourceRepository;
use App\Source;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Компонент источников.
 */
class Sources extends Component
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
     * @throws \Exception
     */
    public function render(): View
    {
        $data['sources'] = $this->sourceRepository->getNames();

        return view('components.sources', $data);
    }
}
