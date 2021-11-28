<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $configurator) {
    // default configuration for services in *this* file
    $services = $configurator->services()
        ->defaults()
        ->autowire()      // Automatically injects dependencies in your services.
        ->autoconfigure() // Automatically registers your services as commands, event subscribers, etc.
    ;

    // makes classes in http/api available to be used as services
    $services->load('App\\Http\\', '../src/Http/*')
        ->tag('controller.service_aruguments')
    ;

    // makes classes in src/services available to be used as services
    $services->load('App\\Services\\', '../src/Services/*')
        ->tag('controller.service_aruguments')
    ;

    // makes some classes in http/modules available to be used as services
    $services->load('App\\Modules\\', '../src/Modules/*')
        ->exclude('../src/Modules/*/{Entities,Data}')
    ;
};
