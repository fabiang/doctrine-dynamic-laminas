<?php

namespace Fabiang\DoctrineDynamic\Service;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Fabiang\DoctrineDynamic\Configuration;
use Fabiang\DoctrineDynamic\ProxyDriver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration as DoctrineConfiguration;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Prophecy\Argument;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-10-05 at 14:51:18.
 *
 * @coversDefaultClass Fabiang\DoctrineDynamic\Service\ProxyDriverFactory
 */
final class ProxyDriverFactoryTest extends TestCase
{

    use ProphecyTrait;

    /**
     * @var ProxyDriverFactory
     */
    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new ProxyDriverFactory;
    }

    /**
     * @covers ::__invoke
     * @covers ::createService
     */
    public function testInvoke()
    {
        $driver1 = $this->prophesize(AnnotationDriver::class)->reveal();

        $mappingDriverChain = $this->prophesize(MappingDriverChain::class);
        $mappingDriverChain->getDrivers()->willReturn([
            'MyNamespace' => $driver1,
        ]);

        $mappingDriverChain->addDriver(
                Argument::that(function($driver) use($driver1) {
                    return $driver->getOriginalDriver() === $driver1;
                }),
                'MyNamespace'
            )
            ->shouldBeCalled();

        $doctrineConfiguration = $this->prophesize(DoctrineConfiguration::class);
        $doctrineConfiguration->getMetadataDriverImpl()
            ->willReturn($mappingDriverChain->reveal());

        $entityManager = $this->prophesize(EntityManager::class);
        $entityManager->getConfiguration()
            ->willReturn($doctrineConfiguration->reveal());

        $configuration = $this->prophesize(Configuration::class);

        $container = $this->prophesize(ServiceLocatorInterface::class);
        $container->get(EntityManager::class)
            ->willReturn($entityManager->reveal());
        $container->get(Configuration::class)
            ->willReturn($configuration->reveal());

        $proxyDrivers = $this->object->__invoke(
            $container->reveal(),
            ProxyDriver::class
        );
        $this->assertIsArray($proxyDrivers);
        $this->assertArrayHasKey('MyNamespace', $proxyDrivers);
        $this->assertInstanceOf(
            ProxyDriver::class,
            $proxyDrivers['MyNamespace']
        );
        $this->assertSame(
            $driver1,
            $proxyDrivers['MyNamespace']->getOriginalDriver()
        );

        $proxyDrivers = $this->object->createService($container->reveal());
        $this->assertIsArray($proxyDrivers);
        $this->assertArrayHasKey('MyNamespace', $proxyDrivers);
        $this->assertInstanceOf(
            ProxyDriver::class,
            $proxyDrivers['MyNamespace']
        );
        $this->assertSame(
            $driver1,
            $proxyDrivers['MyNamespace']->getOriginalDriver()
        );
    }

}
