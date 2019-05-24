<?php

namespace MilesChou\Csphp;

class Parser
{
    /**
     * @param string $csp
     * @return array
     */
    public function parse($csp)
    {
        $policies = array_map(function ($policy) {
            return explode(' ', trim($policy));
        }, explode(';', $csp));

        return array_reduce($policies, function ($carry, $policy) {
            $key = array_shift($policy);

            $carry[$key] = $policy;

            return $carry;
        }, []);
    }
}
