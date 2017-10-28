<?php

namespace GSoares\Hydroponics\Application\Builder\Error;

use GSoares\Hydroponics\Application\Dto\Error\ErrorCollectionDto;
use GSoares\Hydroponics\Application\Dto\Error\ErrorDto;
use GSoares\Hydroponics\Application\Dto\Error\SourceDto;

class ErrorCollectionDtoBuilder
{

    /**
     * @var ErrorDto[]
     */
    private $errors = [];

    /**
     * @var ErrorDto
     */
    private $error;

    /**
     * @param int $code
     * @return $this
     */
    public function configCode($code)
    {
        $this->getError()
            ->code = $code;

        return $this;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function configStatus($status)
    {
        $this->getError()
            ->status = $status;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function configTitle($title)
    {
        $this->getError()
            ->title = $title;

        return $this;
    }

    /**
     * @param string $details
     * @return $this
     */
    public function configDetails($details)
    {
        $this->getError()
            ->details = $details;

        return $this;
    }

    /**
     * @param string $sourcePointer
     * @return $this
     */
    public function configSourcePointer($sourcePointer)
    {
        $this->getError()
            ->source
            ->pointer = $sourcePointer;

        return $this;
    }

    /**
     * @return $this
     */
    public function addError()
    {
        $this->errors[] = $this->error;
        $this->error = null;

        return $this;
    }

    /**
     * @return ErrorCollectionDto
     */
    public function build()
    {
        $errorCollection = new ErrorCollectionDto();
        $errorCollection->errors = $this->errors;

        $this->errors = [];

        return $errorCollection;
    }

    /**
     * @return ErrorDto
     */
    private function getError()
    {
        if ($this->error) {
            return $this->error;
        }

        $this->error = new ErrorDto();
        $this->error->source = new SourceDto();

        return $this->error;
    }
}