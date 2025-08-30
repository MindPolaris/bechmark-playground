<?php

declare(strict_types=1);

namespace MindPolaris\Benchmark\Test;

use DateTimeImmutable;
use MindPolaris\Benchmark\Order;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use ReflectionObject;

class PrivatePropBench
{
    /**
     * @Iterations(10)
     * @Revs(10000)
     */
    public function benchClosure(): void
    {
        $order = new Order();

        $f = function (DateTimeImmutable $date) {
            $this->createdAt = $date;
        };
        $bound = $f->bindTo($order, $order);
        $bound(new DateTimeImmutable('-7 days'));
    }

    /**
     * @Iterations(10)
     * @Revs(10000)
     */
    public function benchReflection(): void
    {
        $order = new Order();

        $reflectionObject = new ReflectionObject($order);

        $createdAtProperty = $reflectionObject->getProperty('createdAt');
        $createdAtProperty->setValue($order, new DateTimeImmutable('-7 days'));
    }
}
