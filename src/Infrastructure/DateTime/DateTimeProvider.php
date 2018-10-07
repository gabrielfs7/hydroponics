<?php

namespace GSoares\Hydroponics\Infrastructure\DateTime;

use DateTimeImmutable;
use DateTimeInterface;

class DateTimeProvider
{
    public function current(): DateTimeInterface
    {
        return new DateTimeImmutable('now');
    }
}
