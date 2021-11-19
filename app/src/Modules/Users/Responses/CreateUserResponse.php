<?php

declare(strict_types=1);

namespace App\Modules\Users\Responses;

use App\Common\Responses\CreateEntityResponse;
use App\Modules\Users\Entities\User;
use Doctrine\Common\Collections\ArrayCollection;

final class CreateUserResponse extends CreateEntityResponse
{
    public function __construct(private ?User $user, private int $statusCode, private ArrayCollection $notices)
    {
        parent::__construct($statusCode, $notices);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getNotices(): ArrayCollection
    {
        return $this->notices;
    }
}
