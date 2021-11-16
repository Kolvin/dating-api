<?php

namespace App\Http\Api\Auth;

use App\Modules\Users\Entities\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/user/login', name: 'api_login', methods: ['GET', 'POST'])]
    public function __invoke(#[CurrentUser] ?User $user): JsonResponse
    {
        $statusCode = 200;

        if (null === $user) {
            $response = ['status' => 'failure'];
            $statusCode = Response::HTTP_BAD_REQUEST;
        } else {
            $token = 'a-jwt';

            $response = [
                'status' => 'success',
                'user' => $user->getEmail(),
                'token' => $token,
            ];
        }

        return $this->json($response, $statusCode);
    }
}
