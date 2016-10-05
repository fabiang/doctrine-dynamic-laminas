<?php

namespace Fabiang\DoctrineDynamic\Service;

use Fabiang\DoctrineDynamic\Configuration;
use Fabiang\DoctrineDynamic\ConfigurationFactory as BaseConfigurationFactory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigurationFactory extends BaseConfigurationFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return Configuration
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $globalConfiguration = $container->get('configuration');

        $configuration = [];
        if (isset($globalConfiguration['doctrine_dynamic'])
            && is_array($globalConfiguration['doctrine_dynamic'])) {
            $configuration = $globalConfiguration['doctrine_dynamic'];
        }

        return $this->factory($configuration);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Configuration
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, Configuration::class);
    }
}
