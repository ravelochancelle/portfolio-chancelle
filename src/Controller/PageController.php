<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Psr\Log\LoggerInterface;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

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

    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(
        Request $request,
        MailerInterface $mailer,
        CsrfTokenManagerInterface $csrfTokenManager,
        LoggerInterface $logger
    ): Response {
        if ($request->isMethod('POST')) {
            $token = new CsrfToken(
                'contact_form',
                (string) $request->request->get('_token', '')
            );

            if (!$csrfTokenManager->isTokenValid($token)) {
                $this->addFlash(
                    'error',
                    'Le formulaire a expiré. Veuillez réessayer.'
                );

                return $this->redirectToRoute('app_contact');
            }

            $name = trim((string) $request->request->get('name', ''));
            $emailAddress = trim((string) $request->request->get('email', ''));
            $subject = trim((string) $request->request->get('subject', ''));
            $message = trim((string) $request->request->get('message', ''));

            if (
                $name === '' ||
                !filter_var($emailAddress, FILTER_VALIDATE_EMAIL) ||
                $message === ''
            ) {
                $this->addFlash(
                    'error',
                    'Veuillez vérifier votre nom, votre adresse e-mail et votre message.'
                );

                return $this->redirectToRoute('app_contact');
            }

            try {
                $email = (new Email())
                    ->from('ravelosoa.chancelle@gmail.com')
                    ->to('ravelosoa.chancelle@gmail.com')
                    ->replyTo($emailAddress)
                    ->subject(
                        $subject !== ''
                            ? $subject
                            : 'Message depuis mon portfolio'
                    )
                    ->text(
                        "Nom : {$name}\n" .
                            "Adresse e-mail : {$emailAddress}\n\n" .
                            "Message :\n{$message}"
                    );

                $mailer->send($email);

                $this->addFlash(
                    'success',
                    'Votre message a bien été envoyé. Merci pour votre prise de contact !'
                );
            } catch (\Throwable $exception) {
                $logger->error(
                    'Échec de l’envoi du formulaire de contact.',
                    ['exception' => $exception]
                );

                $this->addFlash(
                    'error',
                    'L’envoi du message a échoué. Veuillez réessayer ultérieurement.'
                );
            }

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('page/contact.html.twig');
    }
}
