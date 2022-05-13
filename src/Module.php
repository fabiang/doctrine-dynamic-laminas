<?php

declare(strict_types=1);

namespace Fabiang\DoctrineDynamic;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\DependencyIndicatorInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;
use Laminas\Mvc\Application;
use Laminas\Mvc\MvcEvent;

final class Module implements
    ConfigProviderInterface,
    DependencyIndicatorInterface,
    InitProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig(): iterable
    {
        return require __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleDependencies(): array
    {
        return ['DoctrineORMModule'];
    }

    /**
     * {@inheritDoc}
     */
    public function init(ModuleManagerInterface $manager): void
    {
        $sharedEventManager = $manager->getEventManager()->getSharedManager();
        $listener           = new Listener\RegisterProxyDriverListener();
        $sharedEventManager->attach(
            Application::class,
            MvcEvent::EVENT_BOOTSTRAP,
            [$listener, 'onBootstrap']
        );
    }
}
