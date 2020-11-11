<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDi\AutomaticDiConfig;

class AutomaticDiConfigFactory
{
    public function __invoke(ContainerInterface $container): AutomaticDiConfig
    {
        return AutomaticDiConfig::fromArray($container->get('Config')['di']);
    }
}
