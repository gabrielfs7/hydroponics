<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

use DateTimeInterface;

trait DeletedAtTrait
{
    /** @var DateTimeInterface */
    protected $deletedAt;

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function changeDeletedAt(DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function isDeleted(): bool
    {
        return boolval($this->deletedAt);
    }
}
