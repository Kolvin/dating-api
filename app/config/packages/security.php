<?php

use App\Modules\Users\Entities\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security) {
    $security->enableAuthenticatorManager(true);
    $security->passwordHasher(PasswordAuthenticatedUserInterface::class)
        ->algorithm('auto')
    ;
    $security->provider('app_user_provider')
        ->entity()
            ->class(User::class)
            ->property('email')
    ;

    $security->firewall('dev')
        ->pattern('^/(_(profiler|wdt)|css|images|js)/')
        ->security(false)
    ;

    $security->firewall('api_login')
        ->pattern('^/api/user/login')
        ->stateless(true)
        ->lazy(true)
        ->jsonLogin()
            ->checkPath('api_login')
                ->usernamePath('email')
                ->passwordPath('password')
    ;

//    $security->firewall('api')
//        ->pattern('^/api/v')
//        ->stateless(true)
//        ->guard()
//    ;
};
