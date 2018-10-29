<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use ArrayAccess;
use Doctrine\Common\Collections\Collection;
use GSoares\Hydroponics\Domain\Entity\TankVersion;

trait TankVersionsTrait
{
    /** @var ArrayAccess|Collection */
    protected $tankVersions;

    public function getTankVersions(): ArrayAccess
    {
        return $this->tankVersions;
    }

    public function addVersion(TankVersion $tankVersion): self
    {
        $this->tankVersions->add($tankVersion);

        return $this;
    }

    public function getLastVersion(): TankVersion
    {
        return $this->tankVersions->last();
    }
}
