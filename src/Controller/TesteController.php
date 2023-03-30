<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TesteController extends AbstractController{

    /**
     *@Route("/teste")
     */
    public function index() : Response{

        $data['titulo'] = "Testando";
        $data['paragrafo'] = "Um parágrafo para testar a passagem de valores!";
        $data['frutas'] = [['nome'=>'Banana', 'valor' => 5.30],['nome'=>'Melão', 'valor' => 400],['nome'=>'Abacate', 'valor' => 600]];
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
