<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Midnight\AutomaticDi\AutomaticDiConfig;

class AutomaticDiConfigFactory
{
    public function __invoke(ContainerInterface $container): AutomaticDiConfig
    {
        /**
         * @var array{di: array{
         *         preferences: array<class-string, class-string>,
         *         classes: array<class-string, array<string, class-string>>
         *     }
         * } $config
         */
        $config = $container->get('Config');
        return AutomaticDiConfig::fromArray($config['di']);
    }
}
