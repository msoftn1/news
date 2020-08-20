<?php


namespace App\Console\Commands;


use App\Services\ImportNewsService;
use Illuminate\Console\Command;

/**
 * Команда загружает новости.
 */
class NewsLoadCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $signature = "news:load-news";

    /**
     * {@inheritdoc}
     */
    protected $description = "Скачать новости";

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
        $count = $this->service->loadNews();

        $this->info(sprintf('Импортировано %s новостей', $count));
    }
}
