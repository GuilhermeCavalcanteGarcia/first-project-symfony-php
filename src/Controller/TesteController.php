<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TesteController extends AbstractController{

    /**
     *@Route("/teste")
     */
    public function index(EntityManagerInterface $entityManager, UsuarioRepository $usuarioRepository) : Response{

        

        $data['usuarios'] = $usuarioRepository->findAll();
        $data['paragrafo'] = "Lista de Usuários";
        $data['titulo'] = 'Usuários';

        return $this->render('teste/index.html.twig', $data);

    }
    /**
     *@Route("/teste/nome/{name}")
     */
    public function nome($name) : Response{

        $nameTratado = ucwords($name);

        return new Response("<h1> Executando o segundo método da página de teste, passado o nome $nameTratado na rota ! <h1>");

    }
}

?>
