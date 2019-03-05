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
        $this->policies['default-src'] = new Policy($this, 'default-src');

        return $this->policies['default-src'];
    }

    /**
     * @return Policy
     */
    public function imgSrc()
    {
        $this->policies['img-src'] = new Policy($this, 'img-src');

        return $this->policies['img-src'];
    }

    /**
     * @return Policy
     */
    public function fontSrc()
    {
        return $this->policies['font-src'] = new Policy($this, 'font-src');
    }

    /**
     * @return Policy
     */
    public function mediaSrc()
    {
        return $this->policies['media-src'] = new Policy($this, 'media-src');
    }

    /**
     * @return Policy
     */
    public function objectSrc()
    {
        return $this->policies['object-src'] = new Policy($this, 'object-src');
    }

    /**
     * @return Policy
     */
    public function scriptSrc()
    {
        $this->policies['script-src'] = new Policy($this, 'script-src');

        return $this->policies['script-src'];
    }

    /**
     * @return Policy
     */
    public function styleSrc()
    {
        $this->policies['style-src'] = new Policy($this, 'style-src');

        return $this->policies['style-src'];
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
    public function setFontSrc($policy)
    {
        $this->policies['font-src'] = $policy;

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
    public function setMediaSrc($policy)
    {
        $this->policies['media-src'] = $policy;

        return $this;
    }

    /**
     * @param string $policy
     * @return static
     */
    public function setObjectSrc($policy)
    {
        $this->policies['object-src'] = $policy;

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
