<?php
namespace App\Util\Twig;

use Symfony\Component\Asset\Packages;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\RuntimeExtensionInterface;

class CustomAssetRuntime implements RuntimeExtensionInterface
{
    private $packages;
    private $config;

    public function __construct(ParameterBagInterface $parameterBag, Packages $packages)
    {
        $this->packages = $packages;
        $this->config = $parameterBag->get('asset');
    }

    public function process(string $path): string
    {
        $url = $this->packages->getUrl($path);
        return sprintf('%s?version=%s', $url, $this->config['version']);
    }
}