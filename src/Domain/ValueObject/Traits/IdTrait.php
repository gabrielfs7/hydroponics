<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

trait IdTrait
{
    /** @var int */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
