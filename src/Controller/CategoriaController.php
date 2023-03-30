<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController{

    /**
     * @Route("/categoria", name="categoria_index")
     */
    public function index(EntityManagerInterface $entityManager) : Response 
    {   

        // $entityManager é um objeto que vai auxiliar a execução de ações no Banco de Dados 
        $categoria = new Categoria();
        $categoria->setDescricaocategoria("Informática");

        $msg = "";

        try{
            
            $entityManager->persist($categoria);//Salvar a persistência em nível de memória;
            $entityManager->flush();//Executa em definitivo no banco de dados
            $msg = "Categoria cadastrada com sucesso";
            
        }catch(Exception $e){
            
            $msg = "Erro ao cadastrar categoria !";
            
        }

        return new Response("<h1>".$msg."</h1>");

    }

    /**
     * @Route("/categoria/adicionar", name="categoria_adicionar")
     */
    public function adicionar() : Response{

        $form = $this->createForm(CategoriaType::class);

        $data['titulo'] = "Adicionar uma nova categoria";
        $data['form'] = $form;

        return $this->renderForm('categoria/form.html.twig', $data);

    }

}

?>