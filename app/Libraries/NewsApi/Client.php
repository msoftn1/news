<?php


namespace App\Libraries\NewsApi;


use App\Libraries\NewsApi\Exceptions\NewsApiException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Клиент новостей.
 */
class Client
{
    /** Базовый URI */
    private string $baseUri = 'https://newsapi.org/v2/';

    /** HTTP клиент. */
    private HttpClient $client;

    /**
     * Конструктор.
     */
    public function __construct()
    {
        $this->client = new HttpClient(['base_uri' => $this->baseUri]);
    }

    /**
     * Получить источники.
     *
     * @return \StdClass
     * @throws NewsApiException
     */
    public function getSources(): \StdClass
    {
        return $this->load('sources');
    }

    /**
     * Получить новости.
     *
     * @param string $source
     * @return \StdClass
     * @throws NewsApiException
     */
    public function getNews(string $source): \StdClass
    {
        return $this->load('top-headlines', ['sources' => $source]);
    }

    /**
     * Загрузка данных.
     *
     * @param string $method
     * @param array $params
     * @return \StdClass
     * @throws NewsApiException|GuzzleException
     */
    private function load(string $method, array $params = []): \StdClass
    {
        $data = $this->tryRequest($method, $params);

        if ($data && $data['code'] == 200 && $data['data']->status == 'ok') {
            return $data['data'];
        }

        throw new NewsApiException('Error load sources');
    }

    /**
     * Выполнить запрос.
     *
     * @param string $uri
     * @param array $params
     * @return array|null
     * @throws GuzzleException
     */
    private function tryRequest(string $uri, array $params): ?array
    {
        $data = [];

        try {
            $query = ['apiKey' => ENV('NEWS_API_KEY')];

            $response = $this->client->request('GET', $uri, [
                    'query' => array_merge($params, $query)
                ]
            );

            $json = $response->getBody();
            $jsonData = json_decode($json);
            $data['data'] = $jsonData;
        } catch (\Exception $e) {
        }

        if (isset($response)) {
            $data['code'] = $response->getStatusCode();
        } else {
            $data = null;
        }

        return $data;
    }
}
