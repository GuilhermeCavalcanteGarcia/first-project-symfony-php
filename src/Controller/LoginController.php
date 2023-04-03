<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login_index')]
    public function index(AuthenticationUtils $authUtils): Response
    {
        // Pegar o erro caso retorne algum erro
        $erro = $authUtils->getLastAuthenticationError();

        // Pegar o último email informado pelo usuário
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'erro' => $erro,
            'lastUsername' => $lastUsername
        ]);
    
    }
}
