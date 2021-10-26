<?php

namespace App\Http\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['ping' => 'pong'], 200);
    }
}
