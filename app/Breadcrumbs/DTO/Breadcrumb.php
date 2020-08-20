<?php


namespace App\Breadcrumbs\DTO;

/**
 * Элемент breadcrumbs.
 */
class Breadcrumb
{
    /** url */
    private string $url;

    /** текст ссылки */
    private string $title;

    /**
     * Конструктор.
     *
     * @param string $url
     * @param string $title
     */
    public function __construct(string $url, string $title)
    {
        $this->url = $url;
        $this->title = $title;
    }

    /**
     * Получить URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Получить название.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


}
