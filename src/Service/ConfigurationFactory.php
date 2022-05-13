<?php

declare(strict_types=1);

namespace Fabiang\DoctrineDynamic\Service;

use Fabiang\DoctrineDynamic\Configuration;
use Fabiang\DoctrineDynamic\ConfigurationFactory as BaseConfigurationFactory;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

use function is_array;

class ConfigurationFactory extends BaseConfigurationFactory implements
    FactoryInterface
{
    /**
     * @param string $requestedName
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ): Configuration {
        $globalConfiguration = $container->get('configuration');

        $configuration = [];
        if (
            isset($globalConfiguration['doctrine_dynamic'])
            && is_array($globalConfiguration['doctrine_dynamic'])
        ) {
            $configuration = $globalConfiguration['doctrine_dynamic'];
        }

        return $this->factory($configuration);
    }
}
