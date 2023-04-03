<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController{

    /**
     * @Route("/produto", name="produto_index")
     */
    public function index(ProdutoRepository $produtoRepository) : Response
    {
        // Buscando no Banco de Dados todos os produtos cadastrados e armazenando na variável $data
        
        $data['produtos'] = $produtoRepository->findAll();
        $data['titulo'] = "Produtos Cadastrados";
        $data['mensagem'] = 'Informações';

        return $this->render('produto/index.html.twig', $data);

    }

    /**
     * @Route("/produto/adicionar", name="produto_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $entityManager){

        $msg = "";

        $produto = new Produto();

        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Salvar o novo produto no meu Banco de Dados

            $entityManager->persist($produto);//Salva na memória

            $entityManager->flush();//Salva definitivamente no Banco de Dados

            $msg = "Produto cadastrado com sucesso!";

        }

        $data['titulo'] = "Adicionar novo produto";
        $data['form'] = $form;
        $data['mensagem'] = $msg;

        return $this->render('produto/form.html.twig', $data);

    }
    /**
     * @Route("/produto/editar/{id}", name="produto_editar")
     */
    public function editar($id, Request $request, EntityManagerInterface $entityManager, ProdutoRepository $produtoRepository){

        $msg = '';

        $produto = $produtoRepository->find($id);

        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->flush();// Faz o UPDATE DA CATEGORIA NO BANCO DE DADOS
            $msg = 'Produto editado com sucesso!';

        }
        
        $data['titulo'] = "Editar produto";
        $data['form'] = $form;
        $data['mensagem'] = $msg;

        return $this->render('produto/form.html.twig', $data);

    }
    /**
     * @Route("/produto/excluir/{id}", name="produto_excluir")
     */
    public function excluir($id, EntityManagerInterface $entityManager, ProdutoRepository $produtoRepository){

        
        $produto = $produtoRepository->find($id);
        $entityManager->remove($produto);

        $entityManager->flush();

        return $this->redirectToRoute('produto_index');


    }

}

?>