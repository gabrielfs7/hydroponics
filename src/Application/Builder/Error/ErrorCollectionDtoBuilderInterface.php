<?php

namespace GSoares\Hydroponics\Application\Builder\Error;

use GSoares\Hydroponics\Application\Dto\Error\ErrorCollectionDto;

interface ErrorCollectionDtoBuilderInterface
{

    /**
     * @param int $code
     * @return $this
     */
    public function configCode($code);

    /**
     * @param int $status
     * @return $this
     */
    public function configStatus($status);

    /**
     * @param string $title
     * @return $this
     */
    public function configTitle($title);

    /**
     * @param string $details
     * @return $this
     */
    public function configDetails($details);

    /**
     * @param string $sourcePointer
     * @return $this
     */
    public function configSourcePointer($sourcePointer);

    /**
     * @return $this
     */
    public function addError();

    /**
     * @return ErrorCollectionDto
     */
    public function build();
}
