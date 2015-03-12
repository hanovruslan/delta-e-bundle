<?php

namespace Tests\Evlz\DeltaEBundle\Finder;

use Evlz\DeltaEBundle\DependencyInjection\EvlzDeltaEExtension;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FinderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @var string
     */
    protected $imagePath;

    public function setUp()
    {
        $configs = array(
            //empty
        );
        $extension = new EvlzDeltaEExtension();
        $this->container = new ContainerBuilder();
        $extension->load($configs, $this->container);
        $this->container->compile();
        $this->imagePath = __DIR__ . '/../Fixtures/files/1.jpg';
    }

    public function testFinder()
    {
        /**
         * @var \Evlz\DeltaEBundle\Finder\Finder $finder
         */
        $finder = $this->container->get('evlz_delta_e.finder');
        $colors = array(
            '#9c5925',
            '#ab6029',
            '#522810',
            '#ca6f04',
            '#5c371d',
            '#4f2f1a',
            '#1e1818',
            '#0f1a20',
            '#4c2f27',
            '#5c4537',
        );
        $expectedColors = array(
            313 => '#1e1818',
            218 => '#0f1a20',
            68 => '#4f2f1a',
            63 => '#522810',
            50 => '#5c371d',
            39 => '#4c2f27',
            35 => '#5c4537',
            20 => '#9c5925',
            17 => '#ab6029',
            16 => '#ca6f04',
        );
        $resultColor = $finder->findColorsInImage($this->imagePath, $colors);
        $resultColor = array_flip($resultColor);
        krsort($resultColor);
        $this->assertEquals($expectedColors, $resultColor);
    }
}
