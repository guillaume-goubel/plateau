<?php

namespace App\Service;

use App\Entity\Menu;

class MenuService{

    private $mediaService;

    public function __construct(
        MediaService $mediaService,
        )
    {
        $this->mediaService = $mediaService;
    }

    public function process(Menu $menu)
    {        
        if ($menu->getMainPictureFile()) {
            $path = $this->mediaService->uploadMenuPictures($menu->getMainPictureFile());

            if ($menu->getMainPicture()) {
                $this->mediaService->deleteMenuPictures($menu->getMainPicture());
            }

            $menu->setMainPicture($path);
        }

    }

    public function deleteAllMenuPictures(Menu $menu){

        if ($menu->getMainPicture()) {
            $this->mediaService->deleteMenuPictures($menu->getMainPicture());
        }

    }

}