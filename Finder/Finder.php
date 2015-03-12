<?php

namespace Evlz\DeltaEBundle\Finder;

use Exception;
use Evlz\DeltaEBundle\Converter\ConverterAwareInterface;
use Evlz\DeltaEBundle\Converter\ConverterAwareTrait;
use Imagick;

class Finder implements
        FinderInterface,
        ConverterAwareInterface
{
    use ConverterAwareTrait;

    /**
     * @param string $imagePath
     * @param array $colors
     * @param integer $step
     * @param integer $diff
     *
     * @return array
     */
    public function findColorsInImage($imagePath, $colors, $step = 50, $diff = 10)
    {
        $result = null;
        try {
            $image = $this->getImageByPath($imagePath);
            $imageCountColors = $this->getColorDistribution($image, $step);
            $imageColors = array_keys($imageCountColors);
            $resultColors = [];
            foreach ($colors as $hex) {
                foreach($this->getConverter()->matchSimilar($hex, $imageColors, $diff) as $matchedHex) {
                    if (!isset($resultColors[$hex])) {
                        $resultColors[$hex] = 0;
                    }
                    $resultColors[$hex] += $imageCountColors[$matchedHex];
                }
            }
            $result = $resultColors;
            unset($image);
        } catch (Exception $exception) {
            //do nothing
        }

        return $result;
    }

    protected function getColorDistribution(Imagick $image, $step = 50)
    {
        $result = [];
        for ($y = 0; $y < $image->getimageheight(); $y += $step) {
            for ($x = 0; $x < $image->getimagewidth(); $x += $step) {
                $rgbPixel = $image->getimagepixelcolor($x, $y)->getcolor();
                $key = $this->getConverter()->rgb2hex($rgbPixel['r'], $rgbPixel['g'], $rgbPixel['b']);
                if (!array_key_exists($key, $result)) {
                    $result[$key] = 0;
                }
                $result[$key]++;
            }
        }

        return $result;
    }

    /**
     * @param string $path
     *
     * @return Imagick
     */
    protected function getImageByPath($path)
    {
        $image = new Imagick();
        $image->readImage($path);

        return $image;
    }
}
