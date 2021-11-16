<?php

declare(strict_types=1);

namespace App\Modules\Users\Responses;

use App\Modules\Users\Entities\User;

final class CreateUserResponse
{
    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
