<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Midnight\AutomaticDi\AutomaticDiConfig;
use Psr\Container\ContainerInterface;

class AutomaticDiConfigFactory
{
    public function __invoke(ContainerInterface $container): AutomaticDiConfig
    {
        /**
         * @var array{
         *     di: array{
         *         preferences: array<class-string, class-string>,
         *         classes: array<class-string, array<string, class-string>>
         *     }
         * } $config
         */
        $config = $container->get('Config');
        return AutomaticDiConfig::fromArray($config['di']);
    }
}
