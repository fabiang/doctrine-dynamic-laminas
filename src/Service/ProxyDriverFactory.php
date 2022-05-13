<?php

declare(strict_types=1);

namespace Fabiang\DoctrineDynamic\Service;

use Doctrine\ORM\EntityManager;
use Fabiang\DoctrineDynamic\Configuration;
use Fabiang\DoctrineDynamic\ProxyDriver;
use Fabiang\DoctrineDynamic\ProxyDriverFactory as BaseProxyDriverFactory;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

final class ProxyDriverFactory extends BaseProxyDriverFactory implements
    FactoryInterface
{
    /**
     * @param string $requestedName
     * @return ProxyDriver[]
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): array
    {
        $entityManager = $container->get(EntityManager::class);
        $configuration = $container->get(Configuration::class);
        return $this->factory($entityManager, $configuration);
    }
}
