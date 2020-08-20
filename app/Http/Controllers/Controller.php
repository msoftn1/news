<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Базовый контроллер.
 */
class Controller extends BaseController
{
    /**
     * Ответ в виде json.
     *
     * @param array $data
     * @return Response
     */
    public function jsonResponse(array $data): Response
    {
        return (new Response(json_encode($data), 200))
            ->header('Content-Type', 'application/json');
    }

    /**
     * Ответ в виде json с пагинацией.
     *
     * @param Collection $data
     * @param int $totalCount
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function jsonResponseWithPaginate(Collection $data, int $totalCount, int $page, int $limit): Response
    {
        $response = (new Response(json_encode(['data' => $data]), 200))
            ->header('Content-Type', 'application/json');

        if ($page != null && $limit != null) {
            $response->header('X-Pagination-Total-Count', $totalCount)
                ->header('X-Pagination-Page-Count', count($data))
                ->header('X-Pagination-Current-Page', $page)
                ->header('X-Pagination-Per-Page', $limit);
        }

        return $response;
    }
}
