<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin', name: 'admin_')]

class AdminHomeController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(MenuRepository $menuRepository, EntityManagerInterface $entityManager): Response
    {   
        $user = $this->getUser();

        $dayMenu = $menuRepository->findOneBy(['id' => 1]);
        if (empty($dayMenu)){
            $menu = new Menu();
            $menu->setMainPicture('toto');
            $entityManager->persist($menu);
            $entityManager->flush();
        }
        
        return $this->render('admin/index.html.twig', [
            'menu' => $menuRepository->findOneBy(['id' => 1])
        ]);
    }

}