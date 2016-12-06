<?php declare(strict_types = 1);

namespace MidnightTest\AutomaticDiModule\Asset;

class DependsOnFoo
{
    /** @var Foo */
    private $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function getFoo(): Foo
    {
        return $this->foo;
    }
}
