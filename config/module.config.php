<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Midnight\AutomaticDi\AutomaticDiConfig;
use Midnight\AutomaticDi\AutomaticDiContainer;

return [
    'di' => [
        'preferences' => [],
        'classes' => [],
    ],
    'service_manager' => [
        'factories' => [
            AutomaticDiContainer::class => AutomaticDiContainerFactory::class,
            AutomaticDiConfig::class => AutomaticDiConfigFactory::class,
        ],
        'abstract_factories' => [
            AutomaticDiAbstractFactory::class,
        ],
    ],
];
