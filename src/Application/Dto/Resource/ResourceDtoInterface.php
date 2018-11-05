<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

use stdClass;

interface ResourceDtoInterface
{
    public function getId(): string;

    public function getType(): string;

    public function getAttributes(): stdClass;

    public function getAttributeValue(string $name): ?string;

    /** @var ResourceRelationshipDtoInterface[] */
    public function getRelationships(): array;

    public function getLinks(): ResourceLinksDtoInterface;

    public function getMeta(): array;
}
