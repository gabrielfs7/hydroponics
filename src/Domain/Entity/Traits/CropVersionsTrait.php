<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use ArrayAccess;
use Doctrine\Common\Collections\Collection;
use GSoares\Hydroponics\Domain\Entity\CropVersion;

trait CropVersionsTrait
{
    /** @var ArrayAccess|Collection */
    protected $cropVersions;

    public function getCropVersions(): ArrayAccess
    {
        return $this->cropVersions;
    }

    public function addVersion(CropVersion $cropVersion): self
    {
        $this->cropVersions->add($cropVersion);

        return $this;
    }

    public function getLastVersion(): CropVersion
    {
        return $this->cropVersions->last();
    }
}
