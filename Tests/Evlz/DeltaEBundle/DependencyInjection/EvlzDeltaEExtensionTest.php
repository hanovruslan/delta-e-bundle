<?php

namespace Tests\Evlz\DeltaEBundle\DependencyInjection;

use Evlz\DeltaEBundle\DependencyInjection\EvlzDeltaEExtension;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EvlzDeltaEExtensionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    public function setUp()
    {
        $configs = array(
            //empty
        );
        $extension = new EvlzDeltaEExtension();
        $this->container = new ContainerBuilder();
        $extension->load($configs, $this->container);
    }

    public function testFormulaHandler()
    {
        $this->assertTrue($this->container->has('evlz_delta_e.formula.handler.CIE76'));
        $this->assertTrue($this->container->hasAlias('evlz_delta_e.formula.handler.default'));
    }

    public function testConverter()
    {
        $this->assertTrue($this->container->has('evlz_delta_e.converter'));
        /**
         * @var \Evlz\DeltaEBundle\Converter\Converter $converter
         */
        $converter = $this->container->get('evlz_delta_e.converter');
        $this->assertInstanceOf('Evlz\\DeltaEBundle\\Converter\\ConverterInterface', $converter);
        $this->assertInstanceOf('ColorDifference\\Service\\ColorServiceInterface', $converter->getHandler());
    }
    
    public function testFinder()
    {
        $this->assertTrue($this->container->has('evlz_delta_e.finder'));
        /**
         * @var \Evlz\DeltaEBundle\Finder\Finder $finder
         */
        $finder = $this->container->get('evlz_delta_e.finder');
        $this->assertInstanceOf('Evlz\\DeltaEBundle\\Finder\\FinderInterface', $finder);
        $this->assertInstanceOf('Evlz\\DeltaEBundle\\Converter\\ConverterInterface', $finder->getConverter());
    }
}
