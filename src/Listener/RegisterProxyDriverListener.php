<?php

namespace Fabiang\DoctrineDynamic\Listener;

use Fabiang\DoctrineDynamic\ProxyDriver;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

class RegisterProxyDriverListener implements BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        if ($e instanceof MvcEvent) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $serviceManager->get(ProxyDriver::class);
        }
    }
}
