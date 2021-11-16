<?php

namespace App\Http\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    #[Route('/', name: 'home')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['ping' => 'pong'], 200);
    }
}
