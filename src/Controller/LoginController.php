<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
                $error = $authenticationUtils->getLastAuthenticationError();

                 // last username entered by the user
                 $lastUsername = $authenticationUtils->getLastUsername();

                 $form = $this->createForm(LoginType::class);


          return $this->render('login/index.html.twig', [
                           'form' => $form,
                           'last_username' => $lastUsername,
                           'error'         => $error,
          ]);

    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {

    }
}
