<?php

declare(strict_types=1);

namespace Fabiang\DoctrineDynamic\Listener;

use Fabiang\DoctrineDynamic\ProxyDriver;
use Laminas\EventManager\EventInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\Mvc\MvcEvent;
use Laminas\ServiceManager\ServiceManager;

class RegisterProxyDriverListener implements BootstrapListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e): void
    {
        if ($e instanceof MvcEvent) {
            /** @var ServiceManager $serviceManager */
            $serviceManager = $e->getApplication()->getServiceManager();
            $proxyDrivers   = $serviceManager->get(ProxyDriver::class);
            $serviceManager->setService(
                'fabiang-doctrinedynamic-proxies',
                $proxyDrivers
            );
        }
    }
}
