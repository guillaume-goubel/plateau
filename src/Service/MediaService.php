<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MediaService{

    private $config;
    private $filesystem;

    public function __construct(ParameterBagInterface $parameterBag, Filesystem $filesystem)
    {
        $this->config = $parameterBag->get('media');
        $this->filesystem = $filesystem;
    }
    
    public function uploadMenuPictures(File $file): string
    {
        $name = $this->generateName($file->guessExtension());

        if (!file_exists($this->config['menu_photo_directory'])) {
            mkdir($this->config['menu_photo_directory'], 0775, true);
        };
        
        $file->move($this->config['menu_photo_directory'], $name);
        return $name;
    }

    public function deleteMenuPictures(string $filename): void
    {
        $path = sprintf('%s/%s', $this->config['menu_photo_directory'], $filename);
        if($this->filesystem->exists($path)){
            $this->filesystem->remove($path);
        }
    }

    private function generateName($ext): string
    {
        $random = md5(uniqid("media_", true));
        return sprintf('%s.%s', $random, $ext);
    }

}