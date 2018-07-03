<?php

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDi\AutomaticDiConfig;
use Midnight\AutomaticDi\AutomaticDiContainer;

class AutomaticDiContainerFactory
{
    /**
     * @return AutomaticDiContainer
     */
    public function __invoke(ContainerInterface $container)
    {
        return new AutomaticDiContainer($container, $container->get(AutomaticDiConfig::class));
    }
}
