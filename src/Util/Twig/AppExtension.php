<?php
namespace App\Util\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return array(
            new TwigFunction('customAsset', array(CustomAssetRuntime::class, 'process')),
        );
    }
}
