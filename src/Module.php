<?php

namespace Fabiang\DoctrineDynamic;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;

final class Module implements
    ConfigProviderInterface,
    DependencyIndicatorInterface,
    InitProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return require __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies()
    {
        return ['DoctrineORMModule'];
    }
    
    /**
     * {@inheritDoc}
     */
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
}
