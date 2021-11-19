<?php

namespace App\Common\Responses;

use Doctrine\Common\Collections\ArrayCollection;

class CreateEntityResponse extends BaseResponse
{
    public function __construct(int $statusCode, ArrayCollection $notices)
    {
        parent::__construct(statusCode: $statusCode, notices: $notices);
    }
}
