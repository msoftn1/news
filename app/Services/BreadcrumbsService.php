<?php


namespace App\Services;


use App\Breadcrumbs\BreadcrumbsBuilder;
use App\Repository\NewsRepository;
use App\Repository\SourceRepository;

/**
 * Сервис хлебных крошек.
 */
class BreadcrumbsService
{
    /**
     * Объект строителя breadcrumbs.
     *
     * @return BreadcrumbsBuilder
     */
    public function getBuilder()
    {
        return new BreadcrumbsBuilder();
    }
}
