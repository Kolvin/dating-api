<?php

namespace App\Modules\Users\Data;

class SystemDefaults
{
    public const USERS = [
        [
            'first_name' => 'Calvin',
            'last_name' => 'Taylor',
            'email' => 'taylorcalvin07@gmail.com',
            'mobile' => '07881847929',
            'roles' => [
                0 => 'ROLE_SYS_ADMIN',
            ],
        ],
    ];
}
