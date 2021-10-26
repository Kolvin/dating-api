<?php

use App\Modules\Users\Entities\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security) {
    $security->enableAuthenticatorManager(true);
    $security->passwordHasher(PasswordAuthenticatedUserInterface::class);
    $security->provider('app_user_provider')
        ->entity()
            ->class(User::class)
        ->property('email')
    ;

    $security->firewall('dev')
        ->pattern('^/(_(profiler|wdt)|css|images|js)/')
        ->security(false)
    ;

    $security->firewall('api')
        ->pattern('^/')
        ->lazy(true)
        ->jsonLogin()
            ->checkPath('/login')
            ->usernamePath('security.credentials.login')
            ->passwordPath('security.credentials.password')
    ;
};
