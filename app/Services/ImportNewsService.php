<?php


namespace App\Services;


use App\Libraries\NewsApi\Client;
use App\Libraries\NewsApi\Exceptions\NewsApiException;
use App\Logger\BaseLogger;
use App\Repository\NewsRepository;
use App\Repository\SourceRepository;
use Illuminate\Support\Facades\Storage;

/**
 * Сервис импорта новостей.
 */
class ImportNewsService
{
    /** Клиент загрузки новостей. */
    private Client $client;

    /** Репозиторий источников. */
    private SourceRepository $sourceRepository;

    /** Репозиторий новостей. */
    private NewsRepository $newsRepository;

    /** Логгер. */
    private BaseLogger $logger;

    /**
     * Конструктор.
     *
     * @param Client $client
     * @param SourceRepository $sourceRepository
     * @param NewsRepository $newsRepository
     * @param BaseLogger $logger
     */
    public function __construct(
        Client $client,
        SourceRepository $sourceRepository,
        NewsRepository $newsRepository,
        BaseLogger $logger
    )
    {
        $this->client = $client;
        $this->sourceRepository = $sourceRepository;
        $this->newsRepository = $newsRepository;
        $this->logger = $logger;
    }

    /**
     * Загрузить источники.
     *
     * @return int
     * @throws NewsApiException
     */
    public function loadSources(): int
    {
        $sources = $this->client->getSources();

        $count = 0;

        foreach ($sources->sources as $source) {
            if ($this->sourceRepository->existsByIdentifier($source->id)) {
                continue;
            }

            $this->sourceRepository->create([
                'identifier' => $source->id,
                'name' => $source->name,
                'description' => $source->description,
                'url' => $source->url,
                'category' => $source->category,
                'language' => $source->language,
                'country' => $source->country,
            ]);

            $count++;
        }

        return $count;
    }

    /**
     * Загрузить новости.
     *
     * @return int
     */
    public function loadNews(): int
    {
        $sources = $this->sourceRepository->get();

        $countSources = 0;
        $count = 0;
        foreach ($sources as $source) {
            try {
                $news = $this->client->getNews($source->identifier);

                foreach ($news->articles as $article) {
                    $source = $this->sourceRepository->findByIdentifier($article->source->id);

                    if (!$source) {
                        $this->logger->error(sprintf('Источник новостей для канала "%s" не найден', $article->source));

                        continue;
                    }

                    if (!$article->author || !$article->publishedAt) {
                        continue;
                    }

                    if ($this->newsRepository->existsByAuthorAndPublishedAt($article->author, $article->publishedAt)) {
                        continue;
                    }

                    $data = [];
                    $data['source_id'] = $source->id;
                    $data['author'] = $article->author;
                    $data['title'] = $article->title;
                    $data['description'] = $article->description;
                    $data['url'] = $article->url;
                    $data['url_to_image'] = $article->urlToImage != 'null' ? $article->urlToImage : null;

                    try {
                        if ($data['url_to_image']) {
                            $data['image'] = $this->loadImage($article->urlToImage);
                        }
                    } catch (\Exception $e) {
                        $this->logger->error(sprintf('Ошибка импорта фотографии для новости "%s" из источника "%s"', $news->title, $source->identifier));
                    }

                    $data['published_at'] = new \DateTime($article->publishedAt);
                    $data['content'] = $article->content;

                    $this->newsRepository->create($data);


                    $count++;
                }

                $this->logger->info(sprintf('Импортированы новости из канала "%s"', $source->identifier));

                $countSources++;
            } catch (\Exception $e) {
                $this->logger->error(sprintf('Ошибка импорта новостей из канала "%s"', $source->identifier));
            }
        }

        return $count;
    }

    /**
     * Скачать картинку.
     *
     * @param string $url
     * @return string
     */
    private function loadImage(string $url): string
    {
        $fileName = mt_rand(1000000000, 9999999999);
        $path = 'files/news/' . mt_rand() . $fileName;
        Storage::disk('local')->put($path, file_get_contents($url));

        $extension = null;
        if ((mime_content_type(Storage::disk('local')->path($path))) == 'image/png') {
            $extension = '.png';
        } else {
            $extension = '.jpeg';
        }

        $newPath = $path . $extension;
        Storage::disk('local')->move($path, $newPath);

        return $newPath;
    }
}
