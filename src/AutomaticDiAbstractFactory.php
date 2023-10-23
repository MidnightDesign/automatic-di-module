<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Midnight\AutomaticDi\AutomaticDiContainer;
use Psr\Container\ContainerInterface;

class AutomaticDiAbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return $this->getContainer($container)->has($requestedName);
    }

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): object
    {
        /** @var object $instance */
        $instance = $this->getContainer($container)->get($requestedName);
        return $instance;
    }

    private function getContainer(ContainerInterface $container): AutomaticDiContainer
    {
        return $container->get(AutomaticDiContainer::class);
    }
}
