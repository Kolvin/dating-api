<?php

use App\Modules\Users\Entities\User;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationFailureHandler;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
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

    $security->firewall('login')
        ->pattern('^/api/user/login')
        ->stateless(true)
        ->lazy(true)
        ->jsonLogin()
            ->checkPath('/api/user/login')
            ->usernamePath('email')
            ->passwordPath('password')
            ->successHandler(AuthenticationSuccessHandler::class)
            ->failureHandler(AuthenticationFailureHandler::class)
    ;

    $security->firewall('api')
        ->pattern('^/api/v')
        ->stateless(true)
    ;
};
