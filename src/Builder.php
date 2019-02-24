<?php

namespace MilesChou\Csphp;

class Builder
{
    /**
     * @var array
     */
    private $policies = [];

    /**
     * @return string
     */
    public function build()
    {
        return implode('; ', array_map(function ($value, $key) {
            if ($value instanceof Policy) {
                return (string)$value;
            }

            return "${key} ${value}";
        }, $this->policies, array_keys($this->policies)));
    }

    /**
     * @return Policy
     */
    public function defaultSrc()
    {
        $this->policies['default-src'] = new Policy('default-src');

        return $this->policies['default-src'];
    }

    /**
     * @param string $policy
     * @return static
     */
    public function setDefaultSrc($policy)
    {
        $this->policies['default-src'] = $policy;

        return $this;
    }

    /**
     * @param string $policy
     * @return static
     */
    public function setImgSrc($policy)
    {
        $this->policies['img-src'] = $policy;

        return $this;
    }

    /**
     * @param string $policy
     * @return static
     */
    public function setScriptSrc($policy)
    {
        $this->policies['script-src'] = $policy;

        return $this;
    }

    /**
     * @param string $policy
     * @return static
     */
    public function setStyleSrc($policy)
    {
        $this->policies['style-src'] = $policy;

        return $this;
    }
}
