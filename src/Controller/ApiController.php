<?php

namespace App\Controller;

use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/produtos', name: 'api_produtos')]
    public function produtos(ProdutoRepository $produtoRepository) : Response
    {   

        $listProdutos = $produtoRepository->findAll();

        return $this->json($listProdutos, 200, [], ['groups' => ['api_list']]);

    }
}
