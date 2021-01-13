<?php

namespace Fabiang\DoctrineDynamic\Listener;

use Fabiang\DoctrineDynamic\ProxyDriver;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\EventManager\EventInterface;
use Laminas\Mvc\MvcEvent;

class RegisterProxyDriverListener implements BootstrapListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        if ($e instanceof MvcEvent) {
            /* @var $serviceManager \Laminas\ServiceManager\ServiceManager */
            $serviceManager = $e->getApplication()->getServiceManager();
            $proxyDrivers = $serviceManager->get(ProxyDriver::class);
            $serviceManager->setService(
                'fabiang-doctrinedynamic-proxies',
                $proxyDrivers
            );
        }
    }
}
