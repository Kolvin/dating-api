<?php

namespace App\Http\Api\Match;

use App\Modules\Users\Entities\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class IndexMatchesController
{
    #[Route('/api/user/matches', name: 'index_matches')]
    public function __invoke(Request $request, #[CurrentUser] ?User $user)
    {
        return new Response('ok');
    }
}