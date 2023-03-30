<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController{

    /**
     * @Route("/produto", name="produto_index")
     */
    public function index(EntityManagerInterface $entityManager, CategoriaRepository $categoriaRepository) : Response
    {
        $categoria = $categoriaRepository->find(1); //1 = Categoria Informática que já foi cadastrada no Banco de Dados
        $produto = new Produto();
        $produto->setNomeproduto("Notebook");
        $produto->setValor(7800);
        $produto->setCategoria($categoria);

        $msg = "";

        try{

            $entityManager->persist($produto); //Salvar a persistência em nível de memória 
            $entityManager->flush(); //Execuita em definitivo no banco de dados
            $msg = "Produto cadastrado com sucesso!";

        }
        catch(Exception $entitiyManager){

            $msg = "Erro ao cadastrar produto";

        }

        return new Response("<h1>".$msg."</h1>");
    }
}


?>