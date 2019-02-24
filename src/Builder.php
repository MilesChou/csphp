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
            return "${key} ${value}";
        }, $this->policies, array_keys($this->policies)));
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
