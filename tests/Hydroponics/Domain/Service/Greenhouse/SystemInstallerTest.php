<?php

namespace GSoares\Hydroponics\Domain\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use PHPUnit\Framework\TestCase;

class SystemInstallerTest extends TestCase
{

    /**
     * @var SystemInstaller
     */
    private $systemInstaller;

    public function setUp()
    {
        $this->systemInstaller = new SystemInstaller();
    }

    public function testInstall()
    {
        $tank = new Tank('Tank', 1.5);
        $greenhouse = new Greenhouse('greenhouse');
        $system = new System('NFT', $greenhouse, $tank);

        $this->assertEquals($system, $this->systemInstaller->install($greenhouse, $system));
    }
}
