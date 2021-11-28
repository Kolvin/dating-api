<?php

declare(strict_types=1);

namespace App\Modules\Users\Interfaces;

use App\Modules\Users\Entities\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function delete(User $user): void;
}
