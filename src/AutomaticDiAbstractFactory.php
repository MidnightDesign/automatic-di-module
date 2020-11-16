<?php

declare(strict_types=1);

namespace Midnight\AutomaticDiModule;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Midnight\AutomaticDi\AutomaticDiContainer;

class AutomaticDiAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @param string $requestedName
     * @phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return $this->getContainer($container)->has($requestedName);
    }

    /**
     * @param string $requestedName
     * @param array<string, mixed>|mixed[]|null $options
     * @return object
     * @phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcs:disable SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint
     * @phpcs:disable SlevomatCodingStandard.TypeHints.NullableTypeForNullDefaultValue.NullabilitySymbolRequired
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getContainer($container)->get($requestedName);
    }

    private function getContainer(ContainerInterface $container): AutomaticDiContainer
    {
        return $container->get(AutomaticDiContainer::class);
    }
}
