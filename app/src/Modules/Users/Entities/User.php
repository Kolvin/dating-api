<?php

namespace App\Modules\Users\Entities;

use Doctrine\ORM\Mapping\ClassMetadata;

class User
{
    private string $id;

    private string $email;

    public function __construct()
    {
    }

    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $metadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'type' => 'integer',
        ]);

        $metadata->mapField([
            'fieldName' => 'email',
            'type' => 'string',
        ]);
    }
}
