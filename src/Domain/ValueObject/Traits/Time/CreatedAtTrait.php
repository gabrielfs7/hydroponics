<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use DateTimeInterface;

trait CreatedAtTrait
{
    /** @var DateTimeInterface */
    protected $createdAt;

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function changeCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
