<?php declare(strict_types = 1);

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDi\AutomaticDiConfig;
use Midnight\AutomaticDi\AutomaticDiContainer;

class AutomaticDiContainerFactory
{
    public function __invoke(ContainerInterface $container): AutomaticDiContainer
    {
        return new AutomaticDiContainer($container, $container->get(AutomaticDiConfig::class));
    }
}
