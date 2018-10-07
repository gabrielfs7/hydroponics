<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

trait NameTrait
{
    /** @var string */
    protected $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function changeName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
