<?php

namespace GSoares\Hydroponics\Infrastructure\Transport;

class ParameterBag extends \ArrayObject
{
    public function importFromArray(array $request): void
    {
        foreach ($request as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    public function get(string $index, mixed $default = null): ?mixed
    {
        if ($this->offsetExists($index)) {
            return $this->offsetGet($index);
        }

        return $default;
    }
}
