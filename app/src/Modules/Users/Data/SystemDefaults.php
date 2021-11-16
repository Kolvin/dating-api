<?php

declare(strict_types=1);

namespace App\Modules\Users\Data;

class SystemDefaults
{
    public const USERS = [
        [
            'first_name' => 'Calvin',
            'last_name' => 'Taylor',
            'middle_names' => 'Kerr',
            'email' => 'taylorcalvin07@gmail.com',
            'mobile' => '07881847929',
            'bio' => 'Happily Married',
            'profile_picture_storage_key' => '',
            'roles' => [
                0 => 'ROLE_SYS_ADMIN',
            ],
        ],
    ];
}
