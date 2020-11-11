<?php declare(strict_types = 1);

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\AbstractFactoryInterface;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Midnight\AutomaticDi\AutomaticDiContainer;

class AutomaticDiAbstractFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return $this->canCreate($serviceLocator, $requestedName);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return $this->__invoke($serviceLocator, $requestedName);
    }

    private function getContainer(ContainerInterface $container): AutomaticDiContainer
    {
        if ($container instanceof AbstractPluginManager) {
            $container = $container->getServiceLocator();
        }
        return $container->get(AutomaticDiContainer::class);
    }

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return $this->getContainer($container)->has($requestedName);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getContainer($container)->get($requestedName);
    }
}
