<?php


namespace App\Console\Commands;


use App\Services\ImportNewsService;
use Illuminate\Console\Command;

/**
 * Команда загружает источники новостей.
 */
class NewsLoadSourcesCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $signature = "news:load-sources";

    /**
     * {@inheritdoc}
     */
    protected $description = "Скачать источники новостей";

    /** Сервис импорта новостей. */
    private ImportNewsService $service;

    /**
     * Конструктор.
     *
     * @param ImportNewsService $service
     */
    public function __construct(ImportNewsService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Обработчик команды.
     */
    public function handle(): void
    {
        $count = $this->service->loadSources();

        $this->info(sprintf('Импортировано %s источников', $count));
    }
}
