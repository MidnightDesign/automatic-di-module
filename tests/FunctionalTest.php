<?php

declare(strict_types=1);

namespace MidnightTest\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\ServiceManager;
use Midnight\AutomaticDiModule\Module;
use MidnightTest\AutomaticDiModule\Asset\AlsoDependsOnFooInterface;
use MidnightTest\AutomaticDiModule\Asset\AlternateFoo;
use MidnightTest\AutomaticDiModule\Asset\DependsOnFoo;
use MidnightTest\AutomaticDiModule\Asset\DependsOnFooInterface;
use MidnightTest\AutomaticDiModule\Asset\Foo;
use MidnightTest\AutomaticDiModule\Asset\FooInterface;
use MidnightTest\AutomaticDiModule\Asset\NoDependencies;
use PHPUnit\Framework\TestCase;

use function array_merge;

class FunctionalTest extends TestCase
{
    private const DI = [
        'preferences' => [
            FooInterface::class => Foo::class,
        ],
        'classes' => [
            AlsoDependsOnFooInterface::class => [
                'foo' => AlternateFoo::class,
            ],
        ],
    ];
    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = $this->createServiceManager($this->createConfig());
    }

    public function testGetClassWithoutDependencies(): void
    {
        $service = $this->container->get(NoDependencies::class);

        self::assertInstanceOf(NoDependencies::class, $service);
    }

    public function testInjectInterface(): void
    {
        $service = $this->container->get(DependsOnFooInterface::class);

        self::assertInstanceOf(DependsOnFooInterface::class, $service);
        self::assertInstanceOf(Foo::class, $service->getFoo());
    }

    public function testInjectClass(): void
    {
        $service = $this->container->get(DependsOnFoo::class);

        self::assertInstanceOf(DependsOnFoo::class, $service);
        self::assertInstanceOf(Foo::class, $service->getFoo());
    }

    public function testGetInterface(): void
    {
        $service = $this->container->get(FooInterface::class);

        self::assertInstanceOf(Foo::class, $service);
    }

    public function testInjectByParameter(): void
    {
        $service = $this->container->get(AlsoDependsOnFooInterface::class);

        self::assertInstanceOf(AlsoDependsOnFooInterface::class, $service);
        self::assertInstanceOf(AlternateFoo::class, $service->getFoo());
    }

    /**
     * @param array<string, mixed> $config
     */
    protected function createServiceManager(array $config): ServiceManager
    {
        $container = new ServiceManager($config['service_manager']);
        $container->setService('Config', $config);
        return $container;
    }

    /**
     * @return array<string, mixed>
     */
    private function createConfig(): array
    {
        $module = new Module();
        $config = $module->getConfig();
        $config = array_merge($config, ['di' => self::DI]);
        return $config;
    }
}
