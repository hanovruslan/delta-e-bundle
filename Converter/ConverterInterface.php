<?php

namespace Evlz\DeltaEBundle\Converter;

interface ConverterInterface
{
    /**
     * @param integer $red
     * @param integer $green
     * @param integer $green
     *
     * @return mixed
     */
    public function rgb2hex($red, $green, $green);

    /**
     * @param string $hex
     * @param string[] $stack
     * @param integer $diff
     *
     * @return mixed
     */
    public function matchSimilar($hex, $stack, $diff);
}
