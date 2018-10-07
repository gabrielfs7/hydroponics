<?php

namespace GSoares\Hydroponics\Application\Builder\Error;

use GSoares\Hydroponics\Application\Dto\Error\ErrorCollectionDto;

interface ErrorCollectionDtoBuilderInterface
{
    public function configCode(int $code): self;

    public function configStatus(int $status): self;

    public function configTitle(string $title): self;

    public function configDetails(string $details): self;

    public function configSourcePointer(string $sourcePointer): self;

    public function addError(): self;

    public function build(): ErrorCollectionDto;
}
