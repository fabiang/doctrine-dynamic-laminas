<?php

namespace Fabiang\DoctrineDynamic;

return [
    'doctrine_dynamic' => [],
    'service_manager'  => [
        'factories' => [
            Configuration::class => Service\ConfigurationFactory::class,
            ProxyDriver::class   => Service\ProxyDriverFactory::class,
        ]
    ]
];
