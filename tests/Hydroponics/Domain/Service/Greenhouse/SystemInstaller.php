<?php

namespace GSoares\Hydroponics\Domain\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use SebastianBergmann\CodeCoverage\TestCase;

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
        $greenhouse = new Greenhouse('greenhouse');
        $system = new System('NFT', $greenhouse);

        $this->systemInstaller->install($greenhouse, $system);

        $this->assertContains($system, $greenhouse->getSystems());
    }
}
