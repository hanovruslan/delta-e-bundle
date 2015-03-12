<?php

namespace Evlz\DeltaEBundle\Converter;

use ColorDifference\Service\ColorServiceInterface;

class Converter implements ConverterInterface
{
    /**
     * @param string $hex
     * @param string[] $stack
     * @param integer $diff
     *
     * @return mixed
     */
    public function matchSimilar($hex, $stack, $diff)
    {
        return $this->getHandler()->findHexColor($hex, $stack, $diff);
    }

    /**
     * @param integer $red
     * @param integer $green
     * @param integer $blue
     *
     * @return mixed
     */
    public function rgb2hex($red, $green, $blue)
    {
        return $this->getHandler()->rgb2hex(array($red, $green, $blue));
    }

    /**
     * @var ColorServiceInterface
     */
    protected $handler;

    /**
     * @return ColorServiceInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param ColorServiceInterface $handler
     */
    public function setHandler(ColorServiceInterface $handler)
    {
        $this->handler = $handler;
    }
}
