<?php

declare(strict_types=1);

namespace MidnightTest\AutomaticDiModule\Asset;

class DependsOnFoo
{
    private Foo $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function getFoo(): Foo
    {
        return $this->foo;
    }
}
