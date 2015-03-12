# Delta E Bundle #

Symfony bundle for [PHP implementation of CIE76 which finds difference between colors](https://github.com/solarys/colordiff)

## Install ##

### Add to composer

```
$ composer require evlz/delta-e-bundle:~0.1
```

### Add to the kernel ###

```php
<?php
# app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            # your bundles
            new Evlz\DeltaEBundle\EvlzDeltaEBundle(),            
        );
    }
}
```

### Usage ###

Main function **findColorsInImage**

Parameters:

* Path to the image
* Array of wanted colors
* Step (optional) - distance between pixels those processed in color distribution
* Diff (optional) - distance in [Lab coords](http://en.wikipedia.org/wiki/Lab_color_space) between different color values that matched as similar

```php
<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller

class DefaultController extends Controller
{

    public function someAction(Request $request)
    {
        $imagePath = '/path/to/image.jpg';
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
        $step = 50;
        $diff = 10;
        $colorFinder = $this->get('evlz_delta_e.finder');
        $resultColorDistribution = $colorFinder->findColorsInImage($imagePath, $colors, $step, $diff);
        // other stuff
    }
    /**
     * other actions
     */
}

```
