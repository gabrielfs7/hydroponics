<?php

namespace GSoares\Hydroponics\Application\Dto\Error;

class ErrorDto
{
    /** @var string */
    public $status;

    /** @var string */
    public $code;

    /** @var SourceDto */
    public $source;

    /** @var string */
    public $title;

    /** @var string */
    public $details;
}
