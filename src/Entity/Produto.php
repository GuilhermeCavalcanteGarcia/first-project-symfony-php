<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("api_list")]
    private ?int $id = null;


    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min : 2,
        max : 80,
        minMessage : 'O nome do produto deve possuir mais de 3 caracteres',
        maxMessage : 'O nome do produto deve possuir no máximo 80 caracteres',
    )]
    #[Groups("api_list")]
    private ?string $nomeproduto = null;

    #[ORM\Column(type:"float")]
    #[Assert\Positive(message:'O valor deve ser positvo ! ')]
    #[Groups("api_list")]
    private ?float $valor = null;

    #[ORM\ManyToOne(inversedBy: 'produtos')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("api_list")]
    private ?Categoria $categoria = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeproduto(): ?string
    {
        return $this->nomeproduto;
    }

    public function setNomeproduto(string $nomeproduto): self
    {
        $this->nomeproduto = $nomeproduto;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
