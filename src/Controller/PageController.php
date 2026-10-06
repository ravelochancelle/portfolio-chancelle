<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/parcours', name: 'app_parcours')]
    public function parcours(): Response
    {
        return $this->render('page/parcours.html.twig');
    }

    #[Route('/competences', name: 'app_competences')]
    public function competences(): Response
    {
        return $this->render('page/competences.html.twig');
    }

    #[Route('/projets', name: 'app_projets')]
    public function projets(): Response
    {
        return $this->render('page/projets.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render ('page/contact.html.twig');
    }
}
