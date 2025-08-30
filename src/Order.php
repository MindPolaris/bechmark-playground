<?php

declare(strict_types=1);

namespace MindPolaris\Benchmark;

use DateTimeImmutable;

class Order
{
    private DatetimeImmutable $createdAt;

    public function __construct() {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getCreatedAt(): DatetimeImmutable {
        return $this->createdAt;
    }
}
