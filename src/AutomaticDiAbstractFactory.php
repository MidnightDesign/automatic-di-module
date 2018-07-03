<?php

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDi\AutomaticDiContainer;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

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

    /**
     * @return AutomaticDiContainer
     */
    private function getContainer(ContainerInterface $container)
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
