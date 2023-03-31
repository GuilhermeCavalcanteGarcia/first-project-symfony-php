<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController{

    /**
     * @Route("/categoria", name="categoria_index")
     */
    public function index(CategoriaRepository $categoriaRepository) : Response 
    {   

        // Buscar no banco de dados todas as categorias cadastradas

        $data['categorias'] = $categoriaRepository->findAll();
        $data['titulo'] = 'Categorias cadastradas';
        $data['mensagem'] = 'Informações';

        
       
        return $this->render('categoria/index.html.twig', $data);



    }

    /**
     * @Route("/categoria/adicionar", name="categoria_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $entityManager){
        
        $msg = '';

        $categoria = new Categoria();

        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Salvar a nova categoria no meu Banco de Dados

            $entityManager->persist($categoria);//Salva na memória

            $entityManager->flush();//Salva definitivamente no Banco de Dados

            $msg = "Categoria adicionada com sucesso!";
        }

        $data['titulo'] = "Adicionar uma nova categoria";
        $data['form'] = $form;
        $data['mensagem'] = $msg;

        return $this->render('categoria/form.html.twig', $data);
    }

    /**
     * @Route("/categoria/editar/{id}", name="categoria_editar")
     */
    public function editar($id, Request $request, EntityManagerInterface $entityManager, CategoriaRepository $categoriaRepository){

        $msg = '';

        $categoria = $categoriaRepository->find($id);//Retorna a categoria de acordo com o Id passado como parâmetro
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->flush();// Faz o UPDATE DA CATEGORIA NO BANCO DE DADOS
            $msg = 'Categoria editada com sucesso!';

        }
        $data['titulo'] = "Editar categoria";
        $data['form'] = $form;
        $data['mensagem'] = $msg;

        return $this->render('categoria/form.html.twig', $data);
    }

    /**
     * @Route("/categoria/excluir/{id}", name="categoria_excluir")
     */
    public function excluir($id, EntityManagerInterface $entityManager, CategoriaRepository $categoriaRepository){

        $categoria =  $categoriaRepository->find($id);//Retorna a categoria de acordo com o ID passado

        try
        {
            $entityManager->remove($categoria);//Passa a categoria retornada pelo FIND() e remove a mesma

            $entityManager->flush();//Salva as alterações definitivamente no Banco de Dados
            
            $data['categorias'] = $categoriaRepository->findAll();
            $data['titulo'] = 'Categorias cadastradas';
            $data['mensagem'] = 'Categoria excluída com sucesso !';

            return $this->render('categoria/index.html.twig', $data);
       
        }catch(Exception $e){
            
            $data['categorias'] = $categoriaRepository->findAll();
            $data['titulo'] = 'Categorias cadastradas';
            $data['mensagem'] = 'Exclusão da categoria selecionada indisponível no momento!';

            return $this->render('categoria/index.html.twig', $data);
            
        }
        
    
    }
}

?>