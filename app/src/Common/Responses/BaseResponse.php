<?php

namespace App\Common\Responses;

use Doctrine\Common\Collections\ArrayCollection;

abstract class BaseResponse
{
    public function __construct(private int $statusCode, private ArrayCollection $notices)
    {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getNotices(): ?ArrayCollection
    {
        return $this->notices;
    }
}
