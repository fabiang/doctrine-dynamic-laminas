<?php

namespace Fabiang\DoctrineDynamic\Service;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Fabiang\DoctrineDynamic\Configuration;
use Laminas\ServiceManager\ServiceLocatorInterface;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-10-05 at 14:21:02.
 *
 * @coversDefaultClass Fabiang\DoctrineDynamic\Service\ConfigurationFactory
 */
class ConfigurationFactoryTest extends TestCase
{

    use ProphecyTrait;

    /**
     * @var ConfigurationFactory
     */
    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new ConfigurationFactory();
    }

    /**
     * @covers ::__invoke
     * @covers ::createService
     */
    public function testInvoke()
    {
        $container = $this->prophesize(ServiceLocatorInterface::class);
        $container->get('configuration')->willReturn([
            'doctrine_dynamic' => []
        ]);

        $this->assertInstanceOf(
            Configuration::class,
            $this->object->__invoke($container->reveal(), Configuration::class)
        );

        $this->assertInstanceOf(
            Configuration::class,
            $this->object->createService($container->reveal())
        );
    }

}
