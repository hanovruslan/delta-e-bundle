<?php

namespace Evlz\DeltaEBundle\Converter;

interface ConverterAwareInterface
{
    /**
     * @return ConverterInterface
     */
    public function getConverter();

    /**
     * @param ConverterInterface $converter
     */
    public function setConverter(ConverterInterface $converter);
}
