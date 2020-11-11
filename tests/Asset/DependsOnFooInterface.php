<?php

declare(strict_types=1);

namespace MidnightTest\AutomaticDiModule\Asset;

class DependsOnFooInterface
{
    private FooInterface $foo;

    public function __construct(FooInterface $foo)
    {
        $this->foo = $foo;
    }

    public function getFoo(): FooInterface
    {
        return $this->foo;
    }
}
