<?php

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDi\AutomaticDiConfig;

class AutomaticDiConfigFactory
{
    /**
     * @return AutomaticDiConfig
     */
    public function __invoke(ContainerInterface $container)
    {
        return AutomaticDiConfig::fromArray($container->get('Config')['di']);
    }
}
