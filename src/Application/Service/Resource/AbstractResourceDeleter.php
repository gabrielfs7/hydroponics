<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Service\DeleterInterface;

abstract class AbstractResourceDeleter implements ResourceDeleterInterface
{

    /**
     * @var EncoderInterface
     */
    protected $encoder;

    /**
     * @var DeleterInterface
     */
    protected $deleter;

    public function __construct(
        EncoderInterface $encoder,
        DeleterInterface $deleter
    ) {
        $this->encoder = $encoder;
        $this->deleter = $deleter;
    }

    /**
     * @param string $id
     * @return ResponseDto
     */
    public function delete($id)
    {
        $object = $this->deleter
            ->delete($id);

        $data = $this->encoder
            ->encode($object);

        return new ResponseDto(new ResourceLinksDto('', ''), $data);
    }
}
