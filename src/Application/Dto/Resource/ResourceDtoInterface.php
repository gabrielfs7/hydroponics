<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceRelationshipDtoInterface;

interface ResourceDtoInterface
{
    public function getId(): string;

    public function getType(): string;

    public function getAttributes(): ResourceAttributesDtoInterface;

    public function getAttributeValue(string $name): mixed;

    /** @var ResourceRelationshipDtoInterface[] */
    public function getRelationships(): array;

    public function getLinks(): ResourceLinksDtoInterface;

    public function getMeta(): array;
}
