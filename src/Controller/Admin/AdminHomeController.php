<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]

class AdminHomeController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {   
        $user = $this->getUser();
        
        return $this->render('admin/index.html.twig', [
        ]);
    }

}