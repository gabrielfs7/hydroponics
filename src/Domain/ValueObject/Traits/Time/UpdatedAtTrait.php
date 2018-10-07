<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use DateTimeInterface;

trait UpdatedAtTrait
{
    /** @var DateTimeInterface */
    protected $updatedAt;

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function changeUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
