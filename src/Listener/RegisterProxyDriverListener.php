<?php

namespace Fabiang\DoctrineDynamic\Listener;

use Fabiang\DoctrineDynamic\ProxyDriver;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

class RegisterProxyDriverListener implements BootstrapListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        if ($e instanceof MvcEvent) {
            /* @var $serviceManager \Zend\ServiceManager\ServiceManager */
            $serviceManager = $e->getApplication()->getServiceManager();
            $proxyDrivers = $serviceManager->get(ProxyDriver::class);
            $serviceManager->setService(
                'fabiang-doctrinedynamic-proxies',
                $proxyDrivers
            );
        }
    }
}
