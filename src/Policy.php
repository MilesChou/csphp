<?php

namespace MilesChou\Csphp;

/**
 * @mixin Builder
 */
class Policy
{
    /**
     * @var Builder
     */
    private $builder;

    /**
     * @var string
     */
    private $resourceName;

    /**
     * @var bool
     */
    private $allowAll = false;

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
     * @var bool
     */
    private $denyAll = false;

    /**
     * @param Builder $builder
     * @param string $resourceName
     * @return static
     */
    public static function create($builder, $resourceName)
    {
        return new static($builder, $resourceName);
    }

    public function __call($name, $arguments)
    {
        $callable = [$this->builder, $name];

        return call_user_func_array($callable, $arguments);
    }

    /**
     * @param Builder $builder
     * @param string $resourceName
     */
    public function __construct($builder, $resourceName)
    {
        $this->builder = $builder;
        $this->resourceName = $resourceName;
    }

    public function __toString()
    {
        $policy = $this->resourceName;

        if ($this->denyAll) {
            return "${policy} 'none'";
        }

        if ($this->allowAll) {
            return "${policy} *";
        }

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
    public function allowAll()
    {
        $this->allowAll = true;
        $this->denyAll = false;

        return $this;
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

    /**
     * @return static
     */
    public function denyAll()
    {
        $this->allowAll = false;
        $this->denyAll = true;

        return $this;
    }
}
