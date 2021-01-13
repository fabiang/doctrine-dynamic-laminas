<?php

namespace Fabiang\DoctrineDynamic\Service;

use Fabiang\DoctrineDynamic\ProxyDriver;
use Fabiang\DoctrineDynamic\Configuration;
use Fabiang\DoctrineDynamic\ProxyDriverFactory as BaseProxyDriverFactory;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

final class ProxyDriverFactory extends BaseProxyDriverFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return ProxyDriver[]
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $configuration = $container->get(Configuration::class);
        return $this->factory($entityManager, $configuration);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ProxyDriver
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, ProxyDriver::class);
    }
}
