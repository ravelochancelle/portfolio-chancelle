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


    #[Route('/projets', name: 'app_projets')]
    public function projets(): Response
    {
        return $this->render('page/projets.html.twig');
    }


    #[Route('/projets/portfolio-wordpress', name: 'app_projet_wordpress')]
    public function projetWordpress(): Response
    {
        return $this->render('page/projet-wordpress.html.twig');
    }

    #[Route('/projets/mams', name: 'app_projet_mams')]
    public function projetMams(): Response
    {
        return $this->render('page/projet-MAMS.html.twig');
    }


    #[Route('/projets/sortir', name: 'app_projet_sortir')]
    public function projetSortir(): Response
    {
        return $this->render('page/projet-sortir.html.twig');
    }

    #[Route('/projets/skilldev', name: 'app_projet_skilldev')]
    public function projetSkilldev(): Response
    {
        return $this->render('page/projet-skilldev.html.twig');
    }

    #[Route('/services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('page/services.html.twig');
    }

    #[Route('/competences', name: 'app_competences')]
    public function competences(): Response
    {
        return $this->render('page/competences.html.twig');
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig');
    }
}
