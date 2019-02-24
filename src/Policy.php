<?php

namespace MilesChou\Csphp;

class Policy
{
    /**
     * @var string
     */
    private $resourceName;

    /**
     * @var bool
     */
    private $allowSelf = false;

    /**
     * @var bool
     */
    private $allowUnsafeEval = false;

    /**
     * @var bool
     */
    private $allowUnsafeInline = false;

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
        $policy = $this->resourceName;

        if ($this->allowSelf) {
            $policy .= " 'self'";
        }

        if ($this->allowUnsafeEval) {
            $policy .= " 'unsafe-eval'";
        }

        if ($this->allowUnsafeInline) {
            $policy .= " 'unsafe-inline'";
        }

        return $policy !== $this->resourceName ? $policy : '';
    }

    /**
     * @return static
     */
    public function allowSelf()
    {
        $this->allowSelf = true;

        return $this;
    }

    /**
     * @return static
     */
    public function allowUnsafeEval()
    {
        $this->allowUnsafeEval = true;

        return $this;
    }

    public function allowUnsafeInline()
    {
        $this->allowUnsafeInline = true;

        return $this;
    }
}
