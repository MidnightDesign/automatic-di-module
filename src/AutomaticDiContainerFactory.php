<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Midnight\AutomaticDi\AutomaticDiConfig;
use Midnight\AutomaticDi\AutomaticDiContainer;
use Psr\Container\ContainerInterface;

class AutomaticDiContainerFactory
{
    public function __invoke(ContainerInterface $container): AutomaticDiContainer
    {
        return new AutomaticDiContainer($container, $container->get(AutomaticDiConfig::class));
    }
}
