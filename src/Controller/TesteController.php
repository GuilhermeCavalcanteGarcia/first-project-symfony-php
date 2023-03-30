<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TesteController extends AbstractController{

    /**
     *@Route("/rota")
     */
    public function index() : Response{

        return new Response("<h1> Página de teste ! <h1>");

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
