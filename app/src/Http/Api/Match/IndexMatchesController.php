<?php

namespace App\Http\Api\Match;

use App\Modules\Users\Entities\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class IndexMatchesController
{
    #[Route('/api/user/matches', name: 'index_matches')]
    public function __invoke(Request $request, #[CurrentUser] User $user): JsonResponse
    {
        $email = $user->getEmail();

        return new JsonResponse(["Hey $email, here be a protected endpoint"]);
    }
}
