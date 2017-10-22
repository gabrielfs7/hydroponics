<?php

namespace GSoares\Hydroponics\Infrastructure\DateTime;

class DateTimeProvider
{

    /**
     * @return \DateTime
     */
    public function current()
    {
        return new \DateTime('now');
    }
}
