<?php

namespace MilesChou\Csphp;

class Policy
{
    /**
     * @var string
     */
    private $resourceName;

    /**
     * @param string $resourceName
     * @return static
     */
    public static function create($resourceName)
    {
        return new static($resourceName);
    }

    /**
     * @param string $resourceName
     */
    public function __construct($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    public function __toString()
    {
        return $this->resourceName;
    }
}
