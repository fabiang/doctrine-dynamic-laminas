<?php

namespace Fabiang\DoctrineDynamic;

use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;

final class Module implements InitProviderInterface, ConfigProviderInterface
{
    public function init(ModuleManagerInterface $manager)
    {
        $sharedEventManager = $manager->getEventManager()->getSharedManager();
        $listener = new Listener\RegisterProxyDriverListener();
        $sharedEventManager->attach(
            Application::class,
            MvcEvent::EVENT_BOOTSTRAP,
            [$listener, 'onBootstrap']
        );
    }

    public function getConfig()
    {
        return require __DIR__ . '/../config/module.config.php';
    }
}
