<?php

namespace GSoares\Hydroponics\Infrastructure\Transport;

class ParameterBag extends \ArrayObject
{

    /**
     * @param array $request
     */
    public function importFromArray(array $request)
    {
        foreach ($request as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * @param $index
     * @param null $default
     * @return mixed|null
     */
    public function get($index, $default = null)
    {
        if ($this->offsetExists($index)) {
            return $this->offsetGet($index);
        }

        return $default;
    }
}
