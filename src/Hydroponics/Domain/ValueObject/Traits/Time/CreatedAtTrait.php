<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits\Time;

trait CreatedAtTrait
{

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function changeCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
