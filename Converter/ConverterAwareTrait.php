<?php

namespace Evlz\DeltaEBundle\Converter;

trait ConverterAwareTrait
{
    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @return ConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * @param ConverterInterface $converter
     */
    public function setConverter(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }
}
