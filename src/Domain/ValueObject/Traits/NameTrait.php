<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

trait NameTrait
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function changeName($name)
    {
        $this->name = $name;

        return $this;
    }
}
