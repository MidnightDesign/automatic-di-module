<?php

declare(strict_types=1);

namespace MidnightTest\AutomaticDiModule;

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
use Psr\Container\ContainerInterface;

use function array_merge;

/**
 * @phpstan-import-type ServiceManagerConfiguration from ServiceManager
 * @phpstan-type ContainerConfig array{service_manager: array<string, mixed>, di: array<string, mixed>}
 */
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
        $this->container->get(NoDependencies::class);

        $this->expectNotToPerformAssertions();
    }

    public function testInjectInterface(): void
    {
        $service = $this->container->get(DependsOnFooInterface::class);

        self::assertInstanceOf(Foo::class, $service->getFoo());
    }

    public function testInjectClass(): void
    {
        $this->container->get(DependsOnFoo::class);

        $this->expectNotToPerformAssertions();
    }

    public function testGetInterface(): void
    {
        $service = $this->container->get(FooInterface::class);

        self::assertInstanceOf(Foo::class, $service);
    }

    public function testInjectByParameter(): void
    {
        $service = $this->container->get(AlsoDependsOnFooInterface::class);

        self::assertInstanceOf(AlternateFoo::class, $service->getFoo());
    }

    /**
     * @param ContainerConfig $config
     */
    protected function createServiceManager(array $config): ServiceManager
    {
        /** @var ServiceManagerConfiguration $serviceManagerConfig */
        $serviceManagerConfig = $config['service_manager']; // @phpstan-ignore-line seems to be some weird bug
        $container = new ServiceManager($serviceManagerConfig);
        $container->setService('Config', $config);
        return $container;
    }

    /**
     * @return ContainerConfig
     */
    private function createConfig(): array
    {
        $module = new Module();
        $config = $module->getConfig();
        /** @var ContainerConfig $config */
        $config = array_merge($config, ['di' => self::DI]);
        return $config;
    }
}
