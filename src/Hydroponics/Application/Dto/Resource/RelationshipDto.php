<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

class RelationshipDto implements RelationshipDtoInterface
{

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $id;
    
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
