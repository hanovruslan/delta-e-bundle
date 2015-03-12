<?php

namespace Evlz\DeltaEBundle\Finder;

interface FinderInterface
{
    /**
     * @param string $imagePath
     * @param array $resultColors
     * @param integer $step
     * @param integer $diff
     *
     * @return array
     */
    public function findColorsInImage($imagePath, $resultColors, $step = 50, $diff = 10);
}
