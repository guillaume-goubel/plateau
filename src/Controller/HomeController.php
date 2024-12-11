<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MenuRepository $menuRepository, EntityManagerInterface $entityManager): Response
    {
        $dayMenu = $menuRepository->findOneBy(['id' => 1]);
        if (empty($dayMenu)){
            $menu = new Menu();
            $menu->setMainPicture('toto');
            $entityManager->persist($menu);
            $entityManager->flush();
        }
        
        return $this->render('home/index.html.twig', [
            'menu' => $menuRepository->findOneBy(['id' => 1])
        ]);
    }


}
