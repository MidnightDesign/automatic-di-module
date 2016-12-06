<?php declare(strict_types = 1);

namespace MidnightTest\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDiModule\Module;
use MidnightTest\AutomaticDiModule\Asset\AlsoDependsOnFooInterface;
use MidnightTest\AutomaticDiModule\Asset\AlternateFoo;
use MidnightTest\AutomaticDiModule\Asset\DependsOnFoo;
use MidnightTest\AutomaticDiModule\Asset\DependsOnFooInterface;
use MidnightTest\AutomaticDiModule\Asset\Foo;
use MidnightTest\AutomaticDiModule\Asset\FooInterface;
use MidnightTest\AutomaticDiModule\Asset\NoDependencies;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

class FunctionalTest extends TestCase
{
    const DI = [
        'preferences' => [
            FooInterface::class => Foo::class
        ],
        'classes' => [
            AlsoDependsOnFooInterface::class => [
                'foo' => AlternateFoo::class
            ]
        ]
    ];
    /** @var ContainerInterface */
    private $container;

    protected function setUp()
    {
        parent::setUp();

        $this->container = $this->createServiceManager($this->createConfig());
    }

    public function testGetClassWithoutDependencies()
    {
        $service = $this->container->get(NoDependencies::class);

        $this->assertInstanceOf(NoDependencies::class, $service);
    }

    public function testInjectInterface()
    {
        $service = $this->container->get(DependsOnFooInterface::class);

        $this->assertInstanceOf(DependsOnFooInterface::class, $service);
        $this->assertInstanceOf(Foo::class, $service->getFoo());
    }

    public function testInjectClass()
    {
        $service = $this->container->get(DependsOnFoo::class);

        $this->assertInstanceOf(DependsOnFoo::class, $service);
        $this->assertInstanceOf(Foo::class, $service->getFoo());
    }

    public function testGetInterface()
    {
        $service = $this->container->get(FooInterface::class);

        $this->assertInstanceOf(Foo::class, $service);
    }

    public function testInjectByParameter()
    {
        $service = $this->container->get(AlsoDependsOnFooInterface::class);

        $this->assertInstanceOf(AlsoDependsOnFooInterface::class, $service);
        $this->assertInstanceOf(AlternateFoo::class, $service->getFoo());
    }

    protected function createServiceManager(array $config): ServiceManager
    {
        try {
            $container = new ServiceManager(new Config($config['service_manager']));
        } catch (\TypeError $e) {
            $container = new ServiceManager($config['service_manager']);
        }
        $container->setService('Config', $config);
        return $container;
    }

    private function createConfig(): array
    {
        $module = new Module;
        $config = $module->getConfig();
        $config = array_merge($config, ['di' => self::DI]);
        return $config;
    }
}
