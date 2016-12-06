<?php declare(strict_types = 1);

namespace MidnightTest\AutomaticDiModule\Asset;

class AlsoDependsOnFooInterface
{
    /** @var FooInterface */
    private $foo;

    public function __construct(FooInterface $foo)
    {
        $this->foo = $foo;
    }

    public function getFoo(): FooInterface
    {
        return $this->foo;
    }
}
